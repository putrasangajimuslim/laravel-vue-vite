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

        <h1>Form Tambah Edit Kontak</h1>
        <div class="container">
            <form @submit.prevent="saveChanges">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" v-model="formData.name" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" v-model="formData.email" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="email">Nomor Telepon:</label>
                    <input type="text" v-model="formData.notelp" placeholder="" required>
                </div>

                <div class="form-group">
                    <button type="submit">Tambah</button>
                    <button @click="deleteItem" style="background-color: red; margin-left: 10px;">Delete</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            formData: {
                name: '',
                email: '',
                notelp: '',
            },
        };
    },
    created() {
        // Tangkap ID dari URL menggunakan $route.params
        const id = this.$route.params.id;

        // Lakukan permintaan ke server untuk mendapatkan data dengan ID yang sesuai
        // Misalnya, menggunakan fetch atau Axios untuk mengambil data dari API Laravel
        // Gantilah dengan metode yang sesuai sesuai dengan backend Anda
        this.fetchItemData(id);
    },
    methods: {
        logout() {
            // Kirim permintaan logout ke backend menggunakan Axios
            axios.get('/logout')
                .then(response => {
                    // Berhasil logout, lakukan apa yang diperlukan setelah logout
                    console.log('Berhasil logout');
                    // Contoh: Redirect ke halaman login
                    this.$router.push('/')
                })
                .catch(error => {
                    // Gagal logout, lakukan penanganan kesalahan jika diperlukan
                    console.error('Gagal logout', error);
                });
        },
        page_kontak() {
            this.$router.push('/home');
        },

        fetchItemData(id) {
            // Lakukan permintaan ke server atau sumber data lain sesuai dengan kebutuhan Anda
            // Misalnya, mengambil data dari API menggunakan Axios
            axios.get(`/api/edi_kontak/${id}`)
                .then(response => {
                    this.formData = response.data; // Atur nilai formData berdasarkan data yang diterima
                })
                .catch(error => {
                    console.error(error);
                });
        },

        saveChanges() {
            // Lakukan permintaan ke server untuk menyimpan perubahan
            // Misalnya, menggunakan Axios untuk menyimpan data ke API Laravel
            axios.put(`/api/update_kontak/${this.$route.params.id}`, this.formData)
                .then(response => {
                    // Penanganan jika perubahan berhasil disimpan
                    this.$router.push('/home');
                })
                .catch(error => {
                    console.error(error);
                });
        },
        deleteItem() {
            // Mengirim permintaan hapus data ke server berdasarkan ID dari URL
            const id = this.$route.params.id;
            axios.delete(`/api/delete_kontak/${id}`)
                .then(response => {
                    // Berhasil dihapus, navigasi kembali ke halaman sebelumnya atau lakukan aksi lain
                    this.$router.push('/home');
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

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    resize: vertical;
}

.form-group button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
</style>