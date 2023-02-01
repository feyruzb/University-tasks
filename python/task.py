def encrypt(plain,key):
  
    cipher = ""
# transverse the plain text
    for i in range(len(plain)):
        char = plain[i]
# Encrypt uppercase characters in plain text
        if (char.isupper()):
            cipher += chr((ord(char) + key - 65) % 26 + 65)
# Encrypt lowercase characters in plain text
        else:
            cipher += chr((ord(char) + key - 97) % 26 + 97)
    return cipher

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

#input
action = input("Are you encrypting(a) or decrypting(b): ")
key = int(input ("Enter key: "))
plain = input("Enter text: ")

#encrypting
if action == "a":
    print(encrypt(plain,key))

#decrypting
elif action == "b":
    print(decrypt(plain,key))

print("The following case is the correct")







