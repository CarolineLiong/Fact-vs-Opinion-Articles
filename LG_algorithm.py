import glob
import csv
import re
import pandas as pd
import nltk
nltk.download('stopwords')
from nltk.tokenize import RegexpTokenizer
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
from nltk.stem.snowball import SnowballStemmer
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.naive_bayes import MultinomialNB
from sklearn.linear_model import LogisticRegression


from flask import Flask, redirect, url_for, request, render_template
app = Flask(__name__)

#
# Naive Bayes Algorithm
#

#stopWords is the list of stopWords we will use to filter our dataset
#The SnowballStemmer will be used to stem all the remaining words in the dataset 
stopWords = set(stopwords.words('english'))
stemmer =SnowballStemmer('english')

csv_file = "data/dataset.csv"
dff = pd.read_table(csv_file, sep = ',', names = ['Sentence','Tag'])

#cleaning the words in the dff dataframe
s = pd.Series ([[]], index=dff.index)
dff['Sentence'] = dff['Sentence'].str.lower().str.split().mask(dff['Sentence'].isnull(),s)

#take out the stopwords
dff['Sentence'] = dff['Sentence'].apply(lambda x:' '.join([item for item in x if item not in stopWords]))

#stem the remaining words
dff['Sentence'] = dff['Sentence'].str.lower().str.split().mask(dff['Sentence'].isnull(),s)
dff['Sentence'] = dff['Sentence'].apply(lambda x: ' '.join([stemmer.stem(item) for item in x]))

dff['Tag'] = dff.Tag.map({'NON_FACTUAL': 0, "FACTUAL": 1})

Xf = dff.Sentence
yf = dff.Tag

vf=CountVectorizer()
Xf_data = vf.fit_transform(Xf)

logregf = LogisticRegression()
logregf.fit(Xf_data, yf)


@app.route('/')
def index():
   return render_template('index.html')
   
@app.route('/result', methods = ['POST', 'GET'])
def result():
    if request.method == 'POST':
        input = request.form['input_paragraph']
        
        word_tokens = input.split(" ")
 
        filtered = [w for w in word_tokens if not w in stopWords]
 
        filtered = []
 
        for w in word_tokens:
            if w not in stopWords:
                filtered.append(w)	
        
        filtered = [stemmer.stem(word) for word in filtered]
        test = [' '.join(filtered)]

        
        test_data = vf.transform(test)

        # output to be sent
        predict_result = logregf.predict(test_data)
        pred_prob = logregf.predict_proba(test_data)
        
        output = input
        if len(input) > 30:
            output = input[:30]
            output += "..."
            
        if predict_result == 0:
            prob = round(pred_prob[0][0], 2)
        else:
        	    prob = round(pred_prob[0][1], 2)

        return render_template('result.html', data = output, result = predict_result, prob = prob)
    
    else:
        return render_template('index.html')

if __name__ == '__main__':
   app.run(debug = True)









