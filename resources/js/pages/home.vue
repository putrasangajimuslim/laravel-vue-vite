<template>
    <div>
        <div class="navbar">
            <div class="logo">Laravel</div>
            <ul class="nav-links">
                <li>
                    <button @click="page_kontak"
                        style="background-color: #333; border: none; color: #FFFF; font-size: 20px;">Kontak</button>
                </li>
            </ul>
            <a class="logout-btn" @click="logout" href="#">Logout</a>
        </div>

        <div class="p">
            <h1>Daftar Kontak</h1>
            <div class="mb">
                <button type="button" class="button" @click="tambah_kontak">Tambah</button>
            </div>
            <div class="search-container">
                <input type="text" placeholder="Cari..." class="search-input" v-model="keyword" @input="searchItems" />
                <button class="search-button" @click="searchItems">Cari</button>
            </div>
            <ul class="contact-list" style="">
                <div v-for="item in items" :key="item.id">
                    <!-- Tampilkan data sesuai kebutuhan -->
                    <!-- <p>{{ item.name }}</p> -->
                    <li class="contact-item">
                        <div class="contact-name">{{ item.name }}</div>
                        <div class="contact-name">{{ item.email }}</div>
                        <div class="contact-phone" style="margin-bottom: 10px;">{{ item.notelp }}</div>
                        <span></span>
                        <router-link :to="`/edit/${item.id}`">edit</router-link>
                    </li>
                </div>
                <!-- Tambahkan lebih banyak kontak di sini -->
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            items: [],
            keyword: '',
            userNameLogin: '',
            userIdLogin: '',
        };
    },
    mounted() {
        // Lakukan permintaan Axios saat komponen di-mount
        this.getData();
    },
    methods: {
        getData() {
            const userId = localStorage.getItem('userId');
            const userName = localStorage.getItem('name');

            this.userNameLogin = userName;
            this.userIdLogin = userId;

            axios.get('/api/kontak', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'userid': this.userIdLogin,
                },
            })
                .then((response) => {
                    this.items = response.data.kontaks;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        logout() {
            // Kirim permintaan logout ke backend menggunakan Axios
            axios.get('/logout')
                .then(response => {
                    // Berhasil logout, lakukan apa yang diperlukan setelah logout
                    console.log('Berhasil logout');
                    // Contoh: Redirect ke halaman login
                    localStorage.removeItem('token');
                    localStorage.removeItem('userId');
                    localStorage.removeItem('name');
                    this.$router.push('/')
                })
                .catch(error => {
                    // Gagal logout, lakukan penanganan kesalahan jika diperlukan
                    console.error('Gagal logout', error);
                });
        },

        tambah_kontak() {
            this.$router.push('/create');
        },

        page_kontak() {
            this.$router.push('/home');
        },

        searchItems() {
            axios.get(`/api/search_kontak?keyword=${this.keyword}`)
                .then(response => {
                    this.items = response.data;
                })
                .catch(error => {
                    console.error(error);
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

.navbar {
    display: flex;
    align-items: center;
    background-color: #333;
    color: #fff;
    padding: 10px;
}

.logo {
    font-size: 1.5rem;
    margin-right: 20px;
}

.nav-links {
    list-style: none;
    display: flex;
}

.nav-links li {
    margin-right: 10px;
}

.nav-links li a {
    color: #fff;
    text-decoration: none;
    padding: 5px;
}

.logout-btn {
    margin-left: auto;
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    background-color: #e74c3c;
    border-radius: 5px;
}

.logout-btn:hover {
    background-color: #c0392b;
}

h1 {
    text-align: center;
}

.contact-list {
    list-style: none;
    padding: 0;
}

.contact-item {
    background-color: #f5f5f5;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.contact-name {
    font-weight: bold;
}

.contact-phone {
    color: #666;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 10px;
    /* Nilai ini dapat disesuaikan untuk mengatur tingkat radius */
    cursor: pointer;
}

/* Styling tambahan untuk efek hover */
.button:hover {
    background-color: #0056b3;
}

.p {
    padding: 40px;
}

.search-container {
    position: relative;
    display: inline-block;
}

/* Styling untuk input pencarian */
.search-input {
    padding: 8px 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    outline: none;
    width: 400px;
}

/* Styling untuk tombol pencarian */
.search-button {
    position: absolute;
    top: 0;
    right: 0;
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

/* Hover style untuk tombol pencarian */
.search-button:hover {
    background-color: #0056b3;
}

.mb {
    margin-bottom: 10px;
}
</style>