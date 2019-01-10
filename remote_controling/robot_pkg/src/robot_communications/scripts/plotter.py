#import matplotlib.pyplot as plt


import csv
import numpy as np
from numpy import genfromtxt
import matplotlib.pyplot as plt

#j1List = np.array([])
#for line in file:
#   j1List.append(line)

j1List = []
j2List = []
j3List = []
j4List = []

f = open("joint_movement.txt", "r")
data = f.read()
data = data.split(";")
for x in data:
	joint = x.split(",")
	if joint[0] == "0":
		j1List.append(int(joint[1]))
	elif joint[0] == "1":
		j2List.append(int(joint[1]))
	elif joint[0] == "2":
		j3List.append(int(joint[1]))
	elif joint[0] == "3":
		j4List.append(int(joint[1]))



j1x = range(len(j1List))
j2x = range(len(j2List))
j3x = range(len(j3List))
j4x = range(len(j4List))

plt.show()
#print range(j2List.shape[0])
#print j2List[:,0]
#x = range(lista.shape)
plt.figure()
plt.plot(j1x, j1List, 'y-', label='Base')
plt.legend(loc='upper right')
plt.figure()
plt.plot(j2x, j2List, 'r-', label='Lower arm')
plt.legend(loc='upper right')
plt.figure()
plt.plot(j3x, j3List, 'g-', label='Upper arm')
plt.legend(loc='upper right')
plt.figure()
plt.plot(j4x, j4List, 'b-', label='Wrist')
plt.legend(loc='upper right')
plt.show(block=True)
