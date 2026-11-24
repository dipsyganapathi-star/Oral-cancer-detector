# disease_profile.py

DISEASE_RULES = {
    "Oral_Cancer": {
        "mouth_ulcer": 0.8,
        "white_patch": 0.9,
        "red_patch": 0.8,
        "difficulty_swallowing": 0.9,
        "mouth_lump": 0.9
    },

    "Gum_Disease": {
        "bleeding_gums": 0.9,
        "swollen_gums": 0.8,
        "bad_breath": 0.6,
        "loose_teeth": 0.7
    },

    "Dental_Caries": {
        "tooth_pain": 0.9,
        "bad_breath": 0.4
    },

    "Oral_Lichen_Planus": {
        "white_patch": 0.7,
        "burning_sensation": 0.8
    },

    "Calculus": {
        "hard_deposits": 0.9,
        "bad_breath": 0.5
    },

    "Healthy": {
        "mouth_ulcer": 0.0,
        "bleeding_gums": 0.0
    }
}