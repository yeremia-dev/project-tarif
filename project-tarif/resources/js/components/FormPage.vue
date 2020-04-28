<template>
    <b-container>
        <b-form-row>
            <h3>Pilih Jenis Paket</h3>
            <b-form-select
                v-model="id_kategori"
                :options="kategori"
                value-field="id"
                text-field="kategori">
            </b-form-select>

            <h3>Pilih Asal Pengiriman</h3>
            <b-form-select
                v-model="id_asal"
                :options="asal_pengiriman"
                value-field="id"
                text-field="nama_tempat">
            </b-form-select>

            <h3>Pilih Tujuan Pengiriman</h3>
            <model-list-select :list="tujuan_makanan_non"
                               v-model="id_tujuan_makanan_non"
                               option-value="id"
                               option-text="nama_tempat"
                               placeholder="Pilih Tujuan">
            </model-list-select>

            <h3>Masukan Berat Paket</h3>
            <b-form-input
                id="berat-paket"
                v-model="berat_paket"
                type="text"
                required>
            </b-form-input>
        </b-form-row>


            {{ id_kategori }}
            {{ id_tujuan_makanan_non }}
    </b-container>
</template>

<script>
    import axios from 'axios'
    import { ModelListSelect } from 'vue-search-select';
    export default {
        name: "FormPage",
        components: {
            ModelListSelect
        },
        data(){
            return{
                kategori: [],
                asal_pengiriman: [],
                tujuan_dokumen: [],
                tujuan_makanan_non: [],
                berat: [],
                id_berat: 0,
                id_kategori: 0,
                id_asal: 0,
                id_tujuan_dokumen: 0,
                id_tujuan_makanan_non: 0,
                berat_paket: 0
            }
        },
        async mounted() {
            this.load()
        },
        methods: {
            async load() {
                const beratnya = await axios.get('http://localhost:8000/api/beratdokumen')
                const asalnya = await axios.get('http://localhost:8000/api/asalpengiriman')
                const tujuannya_dok = await axios.get('http://localhost:8000/api/tujuandokumen')
                const tujuannya_makanan_non = await axios.get('http://localhost:8000/api/tujuanmakanan')
                const kategorinya = await axios.get('http://localhost:8000/api/kategori')

                this.berat = beratnya.data
                this.asal_pengiriman = asalnya.data
                this.tujuan_dokumen = tujuannya_dok.data
                this.tujuan_makanan_non = tujuannya_makanan_non.data
                this.kategori = kategorinya.data
            },
        }
    }
</script>

<style scoped>

</style>
