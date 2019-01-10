#!/usr/bin/env python
import rospy
import mysql.connector
import time
from std_msgs.msg import String
from std_msgs.msg import Int32
from std_msgs.msg import Int32MultiArray
from sensor_msgs.msg import *

#Global variables
#current_joints6 = [0,0,0,0,0,0]
current_joints = [0,0,0,0] 
stop_command = False
pub_joint = rospy.Publisher('CPRMoverJointVel', JointState, queue_size=10)
pub_command = rospy.Publisher('CPRMoverCommands', String, queue_size=10)

# DB connection
mydb = mysql.connector.connect(
	host="Hostname",
	user="username",
	passwd="psw",
	database="dbname"
)

mycursor = mydb.cursor()

#Converts joint data to degree (approx)
def convert_joints(joints):
	return int((joints - 0.0024) / 0.0175)
	

def update_position(data):
	joint1 = convert_joints(data.position[0])
	joint2 = convert_joints(data.position[1])
	joint3 = convert_joints(data.position[2])
	joint4 = convert_joints(data.position[3])
	global current_joints 
	current_joints = [joint1, joint2, joint3, joint4]

	sql = "UPDATE robot_data SET joint_orientation = " + r'"' + str(convert_joints(data.position[0])) + ',' + str(convert_joints(data.position[1])) + ',' + str(convert_joints(data.position[2])) + ',' + str(convert_joints(data.position[3])) + r'"' + " WHERE robotID=1"
	
	mycursor.execute(sql)
	mydb.commit()
	

#init all topics
def get_joint_states():
	rospy.init_node('get_joint_states', anonymous=False)
	rospy.Subscriber('joint_states', JointState, update_position)
	rospy.Subscriber('script', String, auto_mode)
	rospy.Subscriber('joint_move', Int32MultiArray, manual_move)
	rospy.Subscriber('manual_target', Int32MultiArray, manual_target_move)
	rospy.Subscriber('stop', String, stop_manipulator)
	rospy.spin()
    
#move joint 1 degree in either direction
def manual_move(data):
	global stop_command
	global current_joints

	stop_command = False
	joint = data.data[0] - 1
	direction = data.data[1]

	if (direction == 0):
		target_dest(joint, current_joints[joint] - 1)
	elif (direction == 1):
		target_dest(joint, current_joints[joint] + 1)

#move all joints to their desired position
def manual_target_move(data):
	global stop_command
	stop_command = False

	target_dest(0, data.data[0])
	target_dest(1, data.data[1])
	target_dest(2, data.data[2])
	target_dest(3, data.data[3])

#preset scripts that requires no interference from user
def auto_mode(data):
	global stop_command
	stop_command = False
		
	start_pos()
	
	if data.data == 'pick1':
		auto_get_first_cube()
	elif data.data == 'pick2':
		auto_get_second_cube()	
	elif data.data == 'pick3':
		script3()
	elif data.data == 'pickAll':
		auto_get_first_cube()
		auto_get_second_cube()
		script3()

#pointing upwards and open the gripper
def start_pos():
	global pub_command

	target_dest(2, 0)
	print "Joint 3 done"
	target_dest(1, 0)
	print "Joint 2 done"
	target_dest(3, 0)
	print "Joint 4 done"
	pub_command.publish("GripperOpen")
	print "Manipulator is in start position"

#Stops the manipulator from moving any further
#Note. Only affect joint movements
def stop_manipulator(data):
	global stop_command
	stop_command = True
	print "Stopped by user"

#automatic script 1
def script1():
	print "Running script 1"
	global pub_command
	print "done script 1"

#automatic mode: Get the cube from furthest away
def auto_get_second_cube():
	print "Running script: Fetching cube from second compartment."
	global pub_command
	pub_command.publish("GripperOpen")
	pub_command.publish("GripperOpen")

	#Get the cube from furthest away
	target_dest(0, 110)
	target_dest(3, 2)
	target_dest(1, 55)
	target_dest(2, 88)
	pub_command.publish("GripperClose")
	pub_command.publish("GripperClose")
	time.sleep(1)

	#Bring the cube and put it on the conveyor belt
	get_clear()
	target_dest(0, -21)
	target_dest(1, 50)
	target_dest(2, 40)
	target_dest(3, 32)
	pub_command.publish("GripperOpen")
	pub_command.publish("GripperOpen")
	get_clear()
	print "done"

#automatic mode: Get the cube from closest
def auto_get_first_cube():
	print "Running script: Fetching cube from first compartment."
	global pub_command
	pub_command.publish("GripperOpen")
	pub_command.publish("GripperOpen")

	#Get the closest cube
	target_dest(0, 111)
	target_dest(1, 42)
	target_dest(2, 104)
	target_dest(3, 27)
	pub_command.publish("GripperClose")
	pub_command.publish("GripperClose")
	time.sleep(1)

	#Bring the cube and put it on the conveyor belt
	get_clear()
	target_dest(0, -21)
	target_dest(1, 48)
	target_dest(2, 40)
	target_dest(3, 32)
	pub_command.publish("GripperOpen")
	pub_command.publish("GripperOpen")
	print "done"

#a position where the base can move freely
def get_clear():
	target_dest(1, 35)
	target_dest(2, 35)
	target_dest(3, 0)

#joint is which joint to move(starting from 0)
#direction 0 = negative direction, 1 = positive direction
def create_message(joint, direction):	
	msg = JointState()
	if (joint == 0) & (direction == 1):
		j1 = 50.0
	elif (joint == 0) & (direction == 0):
		j1 = -50.0
	else:
		j1 = 0.0

	if (joint == 1) & (direction == 1):
		j2 = 50.0
	elif (joint == 1) & (direction == 0):
		j2 = -50.0
	else:
		j2 = 0.0


	if (joint == 2) & (direction == 1):
		j3 = 50.0
	elif (joint == 2) & (direction == 0):
		j3 = -50.0
	else:
		j3 = 0.0


	if (joint == 3) & (direction == 1):
		j4 = 50.0
	elif (joint == 3) & (direction == 0):
		j4 = -50.0
	else:
		j4 = 0.0
	#May be extend for joint with more than 4 joints
	msg.velocity = [(j1), (j2), (j3), (j4), (0.0), (0.0)]
	return msg


#joint = which joint to move
#target = the desired angle
def target_dest(joint, target):
	global current_joints
	global pub_joint
	msg = JointState()
	if (limit_check(joint, target)):
		#f = open("joint_movement.txt", "a")
		#f.write(str(joint) + "," + str(target) + ";")
		#f.close()

		if (target > current_joints[joint]):
			direction = 1
		else:
			direction = 0
		while (current_joints[joint] != target):
			if (stop_command):
				break
			else:
				pub_joint.publish(create_message(joint, direction))

#To not put unneccesary strain on the joints, these are the limits we set for the individual joints.
def limit_check(joint, target):
	if (joint == 0):
		return ((target >= -140) and (target <= 140))
		#actual limit[-150, 150]
	elif (joint == 1):
		return ((target >= -20) and (target <= 55))
		#actual limit[-30, 60]
	elif (joint == 2):
		return ((target >= -30) and (target <= 130))
		#actual limit[-40, 140]
	elif (joint == 3):
		return ((target >= -120) and (target <= 120))
		#actual limit[-130, 130]

if __name__ == '__main__':
	get_joint_states()
