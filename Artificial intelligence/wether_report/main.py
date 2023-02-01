import pandas as pd
import numpy as np
import sklearn
from sklearn import svm,preprocessing
# df = pd.read_csv("weather.csv", index_col=0) # 2021 - 2022
# df2 = pd.read_csv("weather2.csv", index_col=0) # 2020 - 2021

# df["is_rain"] = df["icon"].map({"rain":1,"partly-cloudy-day":0,"snow":1,"cloudy":0,"clear-day":0})
# df2["is_rain"] = df2["icon"].map({"rain":1,"partly-cloudy-day":0,"snow":1,"cloudy":0,"clear-day":0})

# # print(df)

# X = [df["is_rain"].astype("category"),df2["is_rain"].astype("category")]
# # print(X)
# y = df["datetime"].values
# clf = svm.SVC()
# result = clf.fit(X, y)
import pandas as pd 

df = pd.read_csv("weather.csv" , index_col = 0)
df["icon"].unique
icon_class_dict = {"rain":2,"partly-cloudy-day":1,"snow":2,"cloudy":1,"clear-day":1}
df["icon"] = df["icon"].map(icon_class_dict)
df.head()





    

