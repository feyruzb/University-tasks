def decrypt(plain,key):
    
    decipher = ""
# transverse the plain text
    for i in range(len(plain)):
        char = plain[i]
# Dencrypt uppercase characters in plain text
        if (char.isupper()):
            decipher += chr((ord(char) - key - 65) % 26 + 65)
# Dencrypt lowercase characters in plain text
        else:
            decipher += chr((ord(char) - key - 97) % 26 + 97)
    return decipher


#inputJicvyd
print("This is brute force attack , please follow the instructions")
plain = input("Enter the text, after that it will be decrypted: ")

# 
for key in range(25):
        print(("Using key: ") + str(key) +" "+ "The decryption with that key is: " + decrypt(plain,key))


