import random
import pandas as pd

symptoms = [
    "mouth_ulcer",
    "white_patch",
    "red_patch",
    "bleeding_gums",
    "swollen_gums",
    "bad_breath",
    "tooth_pain",
    "loose_teeth",
    "difficulty_swallowing",
    "jaw_pain",
    "burning_sensation",
    "mouth_lump"
]

diseases = {
    "Healthy": {},
    
    "Oral_Cancer": {
        "white_patch": 0.8,
        "mouth_lump": 0.9,
        "difficulty_swallowing": 0.8,
        "jaw_pain": 0.6,
        "red_patch": 0.5
    },

    "Oral_Lichen_Planus": {
        "white_patch": 0.7,
        "burning_sensation": 0.7,
        "red_patch": 0.6
    },

    "Gingivitis": {
        "bleeding_gums": 0.9,
        "swollen_gums": 0.8,
        "bad_breath": 0.7
    },

    "Periodontitis": {
        "loose_teeth": 0.9,
        "bleeding_gums": 0.7,
        "bad_breath": 0.6,
        "jaw_pain": 0.5
    },

    "Dental_Caries": {
        "tooth_pain": 0.9,
        "bad_breath": 0.6
    },

    "Calculus": {
        "swollen_gums": 0.6,
        "bleeding_gums": 0.6,
        "bad_breath": 0.7
    }
}

def generate_row(disease):
    row = {s: 0 for s in symptoms}

    if disease == "Healthy":
        return [0]*len(symptoms)

    weights = diseases[disease]

    for symptom, weight in weights.items():
        # probability-based activation
        if random.random() < weight:
            row[symptom] = 1

    return [row[s] for s in symptoms]

data = []

for _ in range(300):  # per disease
    for disease in diseases.keys():
        row = generate_row(disease)
        data.append(row + [disease])

df = pd.DataFrame(data, columns=symptoms + ["disease"])
df.to_csv("symptom_dataset.csv", index=False)

print("Dataset generated successfully:", len(df))