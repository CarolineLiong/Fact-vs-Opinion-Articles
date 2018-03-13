# Fact-vs-Opinion-Articles

CSCI 183 Winter 2018 Final Project

## Authors
Caroline Liongosari, Yueqi Su, Daniel Zhang

## Description
We created this page to easily classify if a sentence, paragraph, or article is factual or opinionated (along with with the percentage of the classifier being accurate). This page is made using the Logistic Regression that had been trained on 99 older news articles with sentences classified as factual or nonfactual

## Installation
#### Install Flask
```
$ pip install Flask
```
Note: It is recommended that Flask should be installed on Python 2.7

#### Install progressbar.js
Using bower 
```
$bower install progressbar.js
```
Using npm
```
$ npm install progressbar.js
```
or download the static/node_modules folder

## Compile UI
```
$ python LG_algorithm.py
```

After compiling, page would be running on http://127.0.0.1:5000/
