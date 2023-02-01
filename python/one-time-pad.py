
import onetimepad

text = input("Enter the text you want to encrypt: ")
key = input("Enter the key: ")


CypheredText = onetimepad.encrypt(str(text),str(key) )



print ("Encrypted text is : " + CypheredText)





decrypted_text = onetimepad.decrypt(CypheredText,str(key))
print("Original/plane Text is :" + decrypted_text)
