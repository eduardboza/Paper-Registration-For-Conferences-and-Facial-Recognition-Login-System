import datetime
import base64
import os
import json

import flask
import tensorflow as tf

from flask import request
from keras.models import load_model
from keras.backend import set_session
from facial import who_is_it, img_to_encoding


app = flask.Flask(__name__)
app.config["DEBUG"] = True

graph = tf.get_default_graph()

sess = tf.Session()
set_session(sess)

model = load_model('facenet_keras.h5', compile=False)

database = {}
# database["Klaus"] = img_to_encoding("images/klaus.jpg", model)                        ->>> need pictures
# database["Levi"] = img_to_encoding("images/captain_levi.jpg", model)
# database["Eren"] = img_to_encoding("images/eren.jpg", model)
# database["Armin"] = img_to_encoding("images/armin.jpg", model)

@app.route('/', methods=['GET'])
def home():
    return "<h1>Distant Reading Archive</h1><p>This site is a prototype API for distant reading of science fiction novels.</p>"

app.route('/verify', methods=['POST'])
def verify():
    img_data = request.get_json()['image64']
    img_name = str(int(datetime.timestamp(datetime.now())))
    with open('images/'+img_name+'.jpg', "wb") as fh:
        fh.write(base64.b64decode(img_data[22:]))
    path = 'images/'+img_name+'.jpg'
    global sess
    global graph
    with graph.as_default():
        set_session(sess)
        min_dist, identity = who_is_it(path, database, model)
    os.remove(path)
    if min_dist > 5:
        return json.dumps({"identity": 0})
    return json.dumps({"identity": str(identity)})


@app.route('/register', methods=['POST'])
def register():
    try:
        username = request.get_json()['username']
        img_data = request.get_json()['image64']
        with open('images/'+username+'.jpg', "wb") as fh:
            fh.write(base64.b64decode(img_data[22:]))
        path = 'images/'+username+'.jpg'
        global sess
        global graph
        with graph.as_default():
            set_session(sess)
            database[username] = img_to_encoding(path, model)    
        return json.dumps({"status": 200})
    except:
        return json.dumps({"status": 500})

app.run()