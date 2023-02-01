from pydoc import plain
import secrets
from Crypto.Cipher import AES
# Parameters 
plaintext = "Hello"
key = secrets.token_bytes(16)


BLOCK_SIZE = 16 # these ar ebites
pad = lambda s: s + (BLOCK_SIZE - len(s) %len(s) % BLOCK_SIZE) * chr(BLOCK_SIZE- len(s) %BLOCK_SIZE)
unpad = lambda s: s[:-ord(s[len(s) -1:])]

iv = secrets.token_bytes(16)
Enc = AES.new(key,AES.MODE_CBC, iv)
data  = pad (plaintext).encode()
ciphertext = Enc.encrypt(data)
ciphertext_hex = iv.hex() + ciphertext.hex()

iv =bytes.fromhex(ciphertext[:32])
ciphertext = bytes.fromhex(ciphertext[:32])
Dec = AES.new(key, AES.MODE_CBC, iv)
pt = Dec.decrypt(ciphertext)





