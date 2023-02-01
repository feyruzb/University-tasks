from random import seed
from random import random

def xor(string1, string2):
    return " ".join([chr(ord(c1) ^ ord(c2)) for (c1,c2) in zip(string1,string2)])



for i in range(10,18):
    seed("2022-02-10 " + str(i))
    key = str(random())[2:]
    text = '4c5c4117525f475e52195a4d'
    decoded =  bytearray.fromhex(text).decode("utf-8")
    print ("Plane text: " + xor(decoded,key))

 

