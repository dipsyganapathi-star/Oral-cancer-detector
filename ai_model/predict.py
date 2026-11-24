import os
import sys
import numpy as np

# Hide TensorFlow warnings
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'

try:
    from tensorflow.keras.models import load_model
    from tensorflow.keras.preprocessing import image

    # ----------------------------
    # MODEL PATH
    # ----------------------------
    current_dir = os.path.dirname(os.path.abspath(__file__))
    model_path = os.path.join(current_dir, "oral_disease_model.h5")

    if not os.path.exists(model_path):
        print("UNKNOWN")
        print("0")
        sys.exit()

    model = load_model(model_path)

    # ----------------------------
    # IMAGE PATH
    # ----------------------------
    if len(sys.argv) < 2:
        print("UNKNOWN")
        print("0")
        sys.exit()

    img_path = sys.argv[1]

    if not os.path.exists(img_path):
        print("UNKNOWN")
        print("0")
        sys.exit()

    # ----------------------------
    # IMAGE PREPROCESSING
    # ----------------------------
    img = image.load_img(img_path, target_size=(128, 128))
    img_array = image.img_to_array(img)
    img_array = img_array / 255.0
    img_array = np.expand_dims(img_array, axis=0)

    # ----------------------------
    # PREDICTION
    # ----------------------------
    prediction = model.predict(img_array, verbose=0)[0]

    predicted_index = np.argmax(prediction)
    confidence = round(float(np.max(prediction)) * 100, 2)

    # ----------------------------
    # CLASS NAMES
    # MUST MATCH TRAINING ORDER
    # ----------------------------
    classes = [
        "Calculus",
        "Dental_Caries",
        "Gum_Disease",
        "Healthy",
        "Mouth_Cancer",
        "Non_oral",
        "Oral_Cancer",
        "Oral_Lichen_Planus",
        "Other_Oral_Disease"
    ]

    if predicted_index >= len(classes):
        print("UNKNOWN")
        print("0")
        sys.exit()

    disease = classes[predicted_index]

    # ----------------------------
    # NON ORAL CHECK
    # ----------------------------
    if disease == "Non_oral":
        print("NON_ORAL")
        print("0")
        sys.exit()

    # ----------------------------
    # FINAL OUTPUT
    # ----------------------------
    print(disease)
    print(confidence)

except Exception as e:
    print("ERROR")
    print(str(e))