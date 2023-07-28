<template>
    <div>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>Form Registration</h2>
                </div>
                <div class="card-body">
                    <form @submit.prevent="register">
                        <input type="text" v-model="name" placeholder="name" required>
                        <input type="email" v-model="email" placeholder="Email" required>
                        <input type="text" v-model="notelp" placeholder="Notelp" required>
                        <input type="password" v-model="password" placeholder="Password" required>
                        <input type="password" v-model="c_password" placeholder="Confirm Password" required>
                        <span style="text-align: end; margin-bottom: 40px; cursor: pointer;" @click="login">Already Account
                            ?</span>
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            notelp: '',
            password: '',
            c_password: '',
        };
    },
    methods: {
        login() {
            this.$router.push('/');
        },
        register() {
            if (this.password !== this.c_password) {
                console.error("Passwords do not match");
                alert("Passwords do not match");
                return;
            }

            // Perform the registration request
            axios.post('/api/register', {
                name: this.name,
                email: this.email,
                notelp: this.notelp,
                password: this.password,
            })
                .then(response => {
                    console.log("Registration successful!");
                    // Optionally, you can do something after a successful registration
                    // For example, show a success message or navigate the user to the login page
                    if (response.data.success === true) { // Check if success is true in the response data
                        // Simpan token di sini (misalnya di local storage)
                        console.log(response.data.token);
                        this.$router.push('/');
                    } else {
                        // Handle the case when success is false
                        // For example, display an error message or do nothing
                        alert('Registration failed. Please check your credentials');
                    }
                })
                .catch(error => {
                    console.error("Registration failed:", error);
                    // Handle the error accordingly
                });
        },
    },
};
</script>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    /* Warna latar belakang biru */
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    /* Mencakup tinggi viewport */
}

.card {
    width: 300px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.card-header {
    padding: 20px;
    text-align: center;
    background-color: #3498db;
    color: #fff;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.card-body {
    padding: 20px;
}

.card-body form {
    display: flex;
    flex-direction: column;
}

.card-body input {
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.card-body button {
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.card-body button:hover {
    background-color: #2980b9;
}
</style>
