import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
import pickle

# Load dataset
df = pd.read_csv("symptom_dataset.csv")

# Split features and label
X = df.drop("disease", axis=1)
y = df["disease"]

# Encode labels
encoder = LabelEncoder()
y_encoded = encoder.fit_transform(y)

# Train-test split
X_train, X_test, y_train, y_test = train_test_split(
    X, y_encoded,
    test_size=0.2,
    random_state=42
)

# Model
model = RandomForestClassifier(
    n_estimators=200,
    max_depth=10,
    random_state=42
)

model.fit(X_train, y_train)

# Accuracy
accuracy = model.score(X_test, y_test)
print("Accuracy:", accuracy * 100)

# Save model
pickle.dump(model, open("symptom_model.pkl", "wb"))
pickle.dump(encoder, open("label_encoder.pkl", "wb"))

print("MODEL TRAINED SUCCESSFULLY")