################ Construction, Analysis and Interface of an industrial mini Process #####################

Web page code is in the folder "website".

- The control part of the website is in the "user.php"-file. The javascript-part of the code is the actual ROS-communication.

- "session_censur.php" need to be changed for your own database implementation, and changed name to just "session.php".


NOTE: You might need to use hamachi since JS is a client based language therefore you will need to be on the same subnet as the computer connected to the manipulator.

###################################################################################################

All ROS code is included in the folder "ROS" we are using kinetic version  
WARNING: These are also configured on the local computer, making it impossible to run as-is. But the important nodes and libraries used are here, such as "cpr_mover" and "rviz". Rosbridge is a requirement for processing outbound connections and turn it into ROS-code.
If you want to use our code as a base download the nodes from:  
cpr_mover: https://github.com/CPR-Robots/cpr_mover  
rviz: https://github.com/ros-visualization/rviz/tree/kinetic-devel  
rosbridge: https://github.com/RobotWebTools/rosbridge_suite/tree/master   
USB PCAN Drivers for CPR mover: https://www.peak-system.com/forum/viewtopic.php?f=59&t=256   

###################################################################################################

Our implementation for recieving outside data and controling the robot is "remote_controling/robot_pkg".

- main Node code is located in "remote_controling/robot_pkg/src/robot_communications/scripts/".

- "Plotter.py" script is history of joint movement.

- "get_joint_states.py" is where control message are recieved, tranformed, and sent to the manipulator node.

- "joint_movement.txt" is where the data for the plotter is stored.

- "mysql.connector" is the login details for the database, to ensure that we can upload manipulator data.


