<template>
    <b-container class="mt-5">
        <h1 style="text-align: center; font-size: 40px" class="mb-3">Cek Tarif Pengiriman</h1>
        <b-row class="mt-5">
            <b-col col md="1">

            </b-col>
            <b-col col md="4">
                <b-row>
                    <h5>Pilih Jenis Paket</h5>
                    <b-form-select
                        v-model="id_kategori"
                        :options="kategori"
                        value-field="id"
                        text-field="kategori"
                        @change="paketDipilih">
                    </b-form-select>
                </b-row>

                <b-row v-if="sudah_dipilih" class="mt-3">
                    <h5>Pilih Asal Pengiriman</h5>
                    <b-form-select
                        v-model="id_asal"
                        :options="asal_pengiriman"
                        value-field="id"
                        text-field="nama_tempat">
                    </b-form-select>
                </b-row>

                <b-row v-if="sudah_dipilih" class="mt-3">
                    <h5>Pilih Tujuan Pengiriman</h5>
                    <model-list-select :list="tujuan"
                                       v-model="id_tujuan"
                                       option-value="id"
                                       option-text="nama_tempat">
                    </model-list-select>
                </b-row>

                <b-row v-if="berat_makanan" class="mt-3">
                    <h5>Masukan Berat Paket (Kg)</h5>
                    <b-form-input
                        id="berat-paket"
                        v-model="berat_paket"
                        type="text"
                        required>
                    </b-form-input>
                </b-row>

                <b-row v-if="berat_dokumen" class="mt-3">
                    <h5>Pilih Berat Dokumen (Kg)</h5>
                    <b-form-select
                        v-model="id_berat"
                        :options="berat"
                        value-field="id"
                        text-field="berat"
                        @change="paketDipilih">
                    </b-form-select>
                </b-row>

                <b-row class="mt-3" v-if="sudah_dipilih">
                    <b-button type="button" @click="getTarif" variant="danger">Cari</b-button>
                </b-row>

                <b-row v-if="sudah_dipilih">
                    {{ total }}
                </b-row>

            </b-col>
            <b-col col  md="1">

            </b-col>
            <b-col col md="5">
                <b-row>
                    <b-col>
                        <h6>Asal</h6>
                        <h3>Jakarta</h3>
                    </b-col>
                    <b-col>
                        <h6>Tujuan</h6>
                        <h3>Jepang</h3>
                    </b-col>
                    <b-col>
                        <h6>Berat (Kg)</h6>
                        <h3>3</h3>
                    </b-col>
                </b-row>
                <b-row class="mt-4">
                    <b-col>
                        <h4><b-icon-bag-fill></b-icon-bag-fill></h4>
                        <h5>Kosmetik, Herbal, dan Makanan</h5>
                    </b-col>
                </b-row>
            </b-col>

        </b-row>
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
                tujuan: [],
                berat: [],

                id_berat: 0,
                id_kategori: 0,
                id_asal: 0,
                id_tujuan: 0,
                berat_paket: 0,

                tarif_makanan: [],
                tarif_berat: [],
                tarif_non_makanan: [],
                total: 0,

                sudah_dipilih: false,
                berat_makanan: false,
                berat_dokumen: false


            }
        },
        async mounted() {
            this.load()
        },
        methods: {
            async load() {
                const beratnya = await axios.get('http://localhost:8000/api/beratdokumen')
                const asalnya = await axios.get('http://localhost:8000/api/asalpengiriman')
                const kategorinya = await axios.get('http://localhost:8000/api/kategori')


                this.berat = beratnya.data
                this.asal_pengiriman = asalnya.data
                this.kategori = kategorinya.data

            },

            async loadTujuanDok(){
                const tujuannya= await axios.get('http://localhost:8000/api/tujuandokumen')
                this.tujuan = tujuannya.data
            },

            async loadTujuanMakananNon(){
                const tujuannya = await axios.get('http://localhost:8000/api/tujuanmakanannon')
                this.tujuan = tujuannya.data
            },

            async loadTujuanMakanan(){
                const tujuannya = await axios.get('http://localhost:8000/api/tujuanmakanan')
                this.tujuan = tujuannya.data
            },

            async getTarif() {
                if (this.id_kategori === 3){
                    const tarif_dokumennya = await axios.get('http://localhost:8000/api/tarifdokumen',
                        { params: { asal: this.id_asal, tujuan: this.id_tujuan, berat: this.id_berat} });

                    this.tarif_berat = tarif_dokumennya.data

                    this.total = this.tarif_berat[0].harga
                }

                else if(this.id_kategori === 1){
                    const tarif_non_makanannya = await axios.get('http://localhost:8000/api/tarifnonmakanan',
                        { params: { asal: this.id_asal, tujuan: this.id_tujuan } });
                    this.tarif_non_makanan = tarif_non_makanannya.data

                    this.total = parseInt(this.tarif_non_makanan[0].harga_awal) +
                        (parseInt(this.tarif_non_makanan[0].harga_selanjutnya)*(parseInt(this.berat_paket)-1))
                }

                else{
                    const tarif_makanannya = await axios.get('http://localhost:8000/api/tarifmakanan',
                        { params: { asal: this.id_asal, tujuan: this.id_tujuan } });
                    this.tarif_makanan = tarif_makanannya.data

                    this.total = parseInt(this.tarif_makanan[0].harga_awal) +
                        (parseInt(this.tarif_makanan[0].harga_selanjutnya)*(parseInt(this.berat_paket)-1))
                }
            },
            paketDipilih() {
                this.sudah_dipilih = true
                if(this.id_kategori === 3){
                    this.berat_dokumen = true
                    this.berat_makanan = false
                    this.loadTujuanDok()
                }else if(this.id_kategori === 2){
                    this.berat_makanan = true
                    this.berat_dokumen = false
                    this.loadTujuanMakananNon()
                }else {
                    this.berat_dokumen = false
                    this.berat_makanan = true
                    this.loadTujuanMakanan()
                }
            }
        }
    }
</script>

<style scoped>

</style>
