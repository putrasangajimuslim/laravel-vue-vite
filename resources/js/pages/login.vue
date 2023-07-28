<template>
    <div>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>Selamat datang</h2>
                </div>
                <div class="card-body">
                    <form @submit.prevent="login">
                        <input type="email" v-model="email" placeholder="Email" required>
                        <input type="password" v-model="password" placeholder="Password" required>
                        <span style="text-align: end; margin-bottom: 40px; cursor: pointer;"
                            @click="register">Register</span>
                        <button type="submit">Login</button>
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
            email: '',
            password: '',
        };
    },
    methods: {
        login() {
            axios.post('/api/login', {
                email: this.email,
                password: this.password,
            })
                .then(response => {
                    // Simpan token di sini (misalnya di local storage)
                    if (response.data.success === true) { // Check if success is true in the response data
                        // Simpan token di sini (misalnya di local storage)
                        console.log(response.data.user);

                        localStorage.setItem('token', response.data.user.token);
                        localStorage.setItem('userId', response.data.user.id);
                        localStorage.setItem('name', response.data.user.name);
                        this.$router.push('/home');
                    } else {
                        // Handle the case when success is false
                        // For example, display an error message or do nothing
                        alert('Login failed. Please check your credentials');
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        },
        register() {
            this.$router.push('/register');
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
