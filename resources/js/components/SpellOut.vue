<script>
export default {
    data() {
        return {
            spellOutText: "",
            languages: [],
            jsonData: {
                number: 0,
                language: "",
            },
        };
    },
    mounted() {
        this.getLanguages();
    },
    methods: {
        sortObject(data) {
            return Object.keys(data)
                .sort()
                .reduce((accumulator, key) => {
                    accumulator[key] = data[key];
                    return accumulator;
                }, {});
        },
        async getLanguages() {
            try {
                const res = await fetch(`/api/languages/list`);
                if (!res.ok) {
                    const message = `An error has occured: ${res.status}`;
                    throw new Error(message);
                }
                const data = await res.json();
                this.languages = Object.entries(this.sortObject(data.data));
            } catch (err) {
                //
            }
        },
        async spellout() {
            try {
                if (
                    this.jsonData.number <= 0 ||
                    this.jsonData.language.length == 0
                )
                    return;
                const res = await fetch(`/api/convert/spellout`, {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(this.jsonData),
                });
                if (!res.ok) {
                    const message = `An error has occured: ${res.status}`;
                    throw new Error(message);
                }
                const data = await res.json();
                this.spellOutText = data.data.spellout;
            } catch (err) {
                //
            }
        },
    },
};
</script>

<template>
    <div class="container">
        <h1>Spelling out of Numbers</h1>
        <div class="flex-container">
            <div class="flex-item">
                <div class="form">
                    <div class="form-group">
                        <label for="number">Number:</label>
                        <input
                            type="number"
                            @input="spellout"
                            id="number"
                            v-model="jsonData.number"
                        />
                    </div>
                    <div class="form-group">
                        <label for="language">Language:</label>
                        <select
                            id="language"
                            @change="spellout()"
                            v-model="jsonData.language"
                        >
                            <option
                                v-for="language in languages"
                                :value="language[0]"
                            >
                                {{ language[1] }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex-item" v-if="spellOutText.length > 0">
                <fieldset>
                    <legend>Spell</legend>
                    <div class="spelloutText">{{ spellOutText }}</div>
                </fieldset>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    width: 30%;
    margin: 10% auto auto;
    background-color: #ffffff7d;
    padding: 20px;
    min-height: 300px;
    border: #bdbaba7e 1px solid;
    border-radius: 4px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
}
.container h1 {
    text-align: center;
}

.flex-container {
    display: flex;
    flex-wrap: wrap;
}

.flex-item {
    background-color: #f2f0f0;
    padding: 10px;
    flex: 100%;
    margin: 10px;
}

.form {
    display: flex;
    flex-direction: column;
    align-content: stretch;
}
.form-group {
    display: flex;
    flex-direction: row;
    padding: 5px;
}

label {
    width: 100px;
    font-size: 16px;
    vertical-align: middle;
    padding: 5px;
}
input,
select {
    width: 100%;
    padding: 5px;
    border: #a4a3a3 1px solid;
    border-radius: 2px;
    background: #ffffff7d;
}

input,
select:focus {
    border-color: rgba(21, 86, 176, 0.694);
}
</style>
