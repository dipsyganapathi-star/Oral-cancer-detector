import sys

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

weights = {
    "Oral_Cancer": {
        "white_patch": 3.5,
        "mouth_lump": 5.0,
        "difficulty_swallowing": 4.5,
        "red_patch": 3.0,
        "mouth_ulcer": 2.5,
        "jaw_pain": 2.0
    },
    "Gum_Disease": {
        "bleeding_gums": 4.0,
        "swollen_gums": 3.5,
        "bad_breath": 2.5,
        "loose_teeth": 4.0
    },
    "Dental_Caries": {
        "tooth_pain": 5.0,
        "bad_breath": 2.0
    },
    "Oral_Lichen_Planus": {
        "white_patch": 4.0,
        "burning_sensation": 3.5
    },
    "Calculus": {
        "bad_breath": 3.0,
        "swollen_gums": 2.0
    },
    "Healthy": {}
}

inputs = list(map(int, sys.argv[1:]))
user = dict(zip(symptoms, inputs))

results = []

for disease, wmap in weights.items():

    score = 0
    max_score = sum(wmap.values()) if wmap else 1
    reasons = []

    for sym, w in wmap.items():
        if user.get(sym, 0) == 1:
            score += w
            reasons.append(sym)

    confidence = round((score / max_score) * 100, 2)

    results.append({
        "disease": disease,
        "confidence": confidence,
        "reason": reasons
    })

results.sort(key=lambda x: x["confidence"], reverse=True)

top = results[0]

for r in results:
    reason_text = ",".join(r["reason"])
    print(f"{r['disease']}:{r['confidence']}:{reason_text}|", end="")