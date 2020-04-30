<template>
    <b-container class="mt-5">
        <h1 style="text-align: center; font-size: 40px" class="mb-3">Cek Tarif Pengiriman</h1>
        <b-row class="mt-5">
            <b-col cols="1" col md="2" lg="" xl="1">

            </b-col>
            <b-col cols="8" col md="7" lg="4" xl="4" class="tengah">
                <b-row>
                    <h5>Pilih Jenis Paket</h5>
                    <b-form-select
                        v-model="id_kategori"
                        :options="kategori"
                        value-field="id"
                        text-field="kategori"
                        required
                        @change="paketDipilih">
                    </b-form-select>
                    <h6 class="text-danger" v-if="kategori_kosong">Plih kategori paket</h6>
                </b-row>

                <b-row class="mt-3">
                    <h5>Pilih Asal Pengiriman</h5>
                    <b-form-select
                        v-model="id_asal"
                        :options="asal_pengiriman"
                        value-field="id"
                        required
                        text-field="nama_tempat"
                        >
                    </b-form-select>
                    <h6 class="text-danger" v-if="asal_kosong">Plih asal pengiriman paket</h6>
                </b-row>

                <b-row class="mt-3">
                    <h5>Pilih Tujuan Pengiriman</h5>
                    <model-list-select :list="tujuan"
                                       v-model="id_tujuan"
                                       option-value="id"
                                       option-text="nama_tempat">
                    </model-list-select>
                    <h6 class="text-danger" v-if="tujuan_kosong">Plih tujuan pengiriman paket</h6>
                </b-row>

                <b-row v-if="berat_makanan" class="mt-3">
                    <h5>Masukan Berat Paket (Kg)</h5>
                    <b-form-input
                        id="berat-paket"
                        v-model="berat_paket"
                        type="text"
                        required>
                    </b-form-input>
                    <h6 class="text-danger" v-if="berat_kosong">Berat paket tidak boleh kosong</h6>
                </b-row>

                <b-row v-if="berat_dokumen" class="mt-3">
                    <h5>Pilih Berat Dokumen (Kg)</h5>
                    <b-form-select
                        v-model="id_berat"
                        :options="berat"
                        value-field="id"
                        text-field="berat"
                        required
                        @change="paketDipilih">
                    </b-form-select>
                    <h6 class="text-danger" v-if="berat_kosong">Pilih berat paket</h6>
                </b-row>

                <b-row class="mt-3">
                    <b-button type="button" @click="getTarif" variant="danger">Cek Tarif</b-button>
                </b-row>
            </b-col>

            <b-col cols="12" class="margin-kiri margin-atas tengah-isi" col lg="6" md="10" xl="6">
                    <div class="metric">
                        <b-row class="mt-4">
                            <b-col style="padding-left: 40px">
                                <h5 class="hitam">Asal</h5>
                                <h5 v-if="kosong">Belum dipilih</h5>
                                <h5 v-else>{{ this.tempat_asal }}</h5>
                            </b-col>
                            <b-col>
                                <h5 class="hitam">Tujuan</h5>
                                <h5 v-if="kosong">Belum dipilih</h5>
                                <h5 v-else>{{ this.tempat_tujuan }}</h5>
                            </b-col>
                            <b-col>
                                <h5 class="hitam">Berat (Kg)</h5>
                                <h5 v-if="kosong">Belum dipilih</h5>
                                <h5 v-else>{{ this.berat_paketnya }}</h5>
                            </b-col>
                        </b-row>
                    </div>

                <div class="metric-tarif">
                    <b-row class="mt-4">
                        <b-col style="padding-left: 40px">
                            <b-row style="padding-left: 10px">
                                <h3 class="hitam"><b-icon-inboxes></b-icon-inboxes></h3>
                                <p class="hitam" style="font-size: 20px; padding-left: 7px; padding-top: 2px">Kategori</p>
                            </b-row>
                            <h5 v-if="kosong" style="margin-top: -15px; margin-left: -3px">( Pilih Kategori )</h5>
                            <div v-else>
                                <h5 style="margin-top: -15px; margin-left: -3px">( {{ this.isi_kategori }} )</h5>
                            </div>
                            <h5 v-if="kosong">Lengkapi form untuk melihat tarif</h5>
                            <div v-else class="mt-4">
                                <h4>
                                    {{ total | numFormat }}
                                </h4>
                                <h4>
                                    IDR
                                </h4>
                            </div>
                        </b-col>
                    </b-row>
                </div>

            </b-col>

<!--menampilkan hasil-->
<!--            <b-col col md="9">-->

<!--                <b-row>-->
<!--                    <b-col>-->
<!--                        <h5 class="hitam">Kategori</h5>-->
<!--                        <h4>{{ this.isi_kategori }}</h4>-->
<!--                    </b-col>-->
<!--                </b-row>-->
<!--                <hr>-->
<!--                <b-row class="mt-4">-->
<!--                    <b-col>-->
<!--                        <h5 class="hitam">Asal</h5>-->
<!--                        <h4>{{ this.tempat_asal }}</h4>-->
<!--                    </b-col>-->
<!--                    <b-col>-->
<!--                        <h5 class="hitam">Tujuan</h5>-->
<!--                        <h4>{{ this.tempat_tujuan }}</h4>-->
<!--                    </b-col>-->
<!--                    <b-col>-->
<!--                        <h5 class="hitam">Berat (Kg)</h5>-->
<!--                        <h4>{{ this.berat_paketnya }}</h4>-->
<!--                    </b-col>-->
<!--                </b-row>-->
<!--                <hr>-->
<!--                <b-row>-->
<!--                    <b-col>-->
<!--                        <h5 class="hitam">Estimasi Tarif</h5>-->
<!--                        <b-card bg-variant="danger" text-variant="white" class="text-center" col md="4">-->
<!--                            <b-card-text><h4>Rp. {{ total | numFormat }}</h4></b-card-text>-->
<!--                        </b-card>-->
<!--                    </b-col>-->
<!--                </b-row>-->
<!--            </b-col>-->


        </b-row>
    </b-container>
</template>

<script>
    import axios from 'axios'
    import { ModelListSelect } from 'vue-search-select';
    import numeral from 'numeral';
    import numFormat from 'vue-filter-number-format';

    Vue.filter('numFormat', numFormat(numeral));

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

                berat_makanan: true,
                berat_dokumen: false,

                tempat_asal: "",
                tempat_tujuan: "",
                berat_paketnya: 0,
                isi_kategori: "",

                kategori_kosong: false,
                asal_kosong: false,
                tujuan_kosong: false,
                berat_kosong: false,
                flag: true,

                kosong: true,

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
                const tujuannya = await axios.get('http://localhost:8000/api/tujuanmakanannon')

                this.tujuan = tujuannya.data
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

            async getAsalnya(){
                const asalnya = await axios.get('http://localhost:8000/api/find/asal',
                    { params: { id: this.id_asal }  });
                this.tempat_asal = asalnya.data[0].nama_tempat
            },

            async getBeratnya(){
                const beratnya = await axios.get('http://localhost:8000/api/find/berat',
                    { params: { id: this.id_berat }  });
                this.berat_paketnya = beratnya.data[0].berat
            },

            async getTujuanMakanan(){
                const tujuanmakanannya = await axios.get('http://localhost:8000/api/find/tujuanmakanan',
                    { params: { id: this.id_tujuan }  });
                this.tempat_tujuan = tujuanmakanannya.data[0].nama_tempat
            },

            async getTujuanNonMakanan(){
                const tujuannonmakanannya = await axios.get('http://localhost:8000/api/find/tujuannonmakanan',
                    { params: { id: this.id_tujuan }  });
                this.tempat_tujuan = tujuannonmakanannya.data[0].nama_tempat
            },

            async getTujuanDokumen(){
                const tujuandokumennya = await axios.get('http://localhost:8000/api/find/tujuandokumen',
                    { params: { id: this.id_tujuan }  });
                this.tempat_tujuan = tujuandokumennya.data[0].nama_tempat
            },

            async getKategori(){
                const kategorinya = await axios.get('http://localhost:8000/api/find/kategori',
                    { params: { id: this.id_kategori }  });
                this.isi_kategori = kategorinya.data[0].kategori
            },

            pengecekan(){

                this.flag = true
                if(this.id_kategori === 0){
                    this.kategori_kosong = true
                    this.flag = false
                }else{
                    this.kategori_kosong = false
                }

                if(this.id_asal === 0){
                    this.asal_kosong = true
                    this.flag = false
                }else{
                    this.asal_kosong = false
                }

                if(this.id_tujuan === 0){
                    this.tujuan_kosong = true
                    this.flag = false
                }else{
                    this.tujuan_kosong = false
                }

                if(this.id_berat === 0 && this.berat_paket === 0){
                    this.berat_kosong = true
                    this.flag = false
                }else{
                    this.berat_kosong = false
                }

                return this.flag
            },


            async getTarif() {
                var cek = this.pengecekan()
                if(cek){
                    this.getKategori()
                    this.getAsalnya()
                    if (this.id_kategori === 3){
                        this.getTujuanDokumen()
                        this.getBeratnya()
                        const tarif_dokumennya = await axios.get('http://localhost:8000/api/tarifdokumen',
                            { params: { asal: this.id_asal, tujuan: this.id_tujuan, berat: this.id_berat} });

                        this.tarif_berat = tarif_dokumennya.data

                        this.total = this.tarif_berat[0].harga
                    }

                    else if(this.id_kategori === 1){
                        this.getTujuanNonMakanan()
                        this.berat_paketnya = this.berat_paket
                        const tarif_non_makanannya = await axios.get('http://localhost:8000/api/tarifnonmakanan',
                            { params: { asal: this.id_asal, tujuan: this.id_tujuan } });
                        this.tarif_non_makanan = tarif_non_makanannya.data

                        this.total = parseInt(this.tarif_non_makanan[0].harga_awal) +
                            (parseInt(this.tarif_non_makanan[0].harga_selanjutnya)*(parseInt(this.berat_paket)-1))
                    }

                    else{
                        this.getTujuanMakanan()
                        this.berat_paketnya = this.berat_paket
                        const tarif_makanannya = await axios.get('http://localhost:8000/api/tarifmakanan',
                            { params: { asal: this.id_asal, tujuan: this.id_tujuan } });
                        this.tarif_makanan = tarif_makanannya.data

                        this.total = parseInt(this.tarif_makanan[0].harga_awal) +
                            (parseInt(this.tarif_makanan[0].harga_selanjutnya)*(parseInt(this.berat_paket)-1))
                    }
                    this.kosong = false
                }

            },

            paketDipilih() {

                    if(this.id_kategori === 3){
                        this.berat_dokumen = true
                        this.berat_makanan = false
                        this.loadTujuanDok()
                    }else if(this.id_kategori === 2){
                        this.berat_makanan = true
                        this.berat_dokumen = false
                        this.loadTujuanMakanan()
                    }else {
                        this.berat_dokumen = false
                        this.berat_makanan = true
                        this.loadTujuanMakananNon()
                    }


            },

        }
    }
</script>

<style scoped>
    .hitam{
        color: #000;
        font-weight: bold;
    }

    .metric {
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #DCE6EB;
    }

    .metric-tarif{
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #DCE6EB;
        -webkit-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.75);
        box-shadow: 0px 2px 5px -2px rgba(0,0,0,0.75);
    }

    .margin-kiri{
        margin-left: 30px

    }

    .header-biru{
        color: #0b0582;
    }

    /* Extra small devices (phones, 600px and down) */
    @media only screen and (max-width: 600px) {
        .margin-atas{
            margin-top: 30px;
        }
        .tengah{
            margin-left: 38px;
        }
        .tengah-isi{
            margin-left: 0px
        }
    }


    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (min-width: 600px) {
        .margin-atas{
            margin-top: 30px;
        }
        .tengah{
            margin-left: 35px;
        }
        .tengah-isi{
            margin-left: 60px
        }
    }


    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width: 768px) {

    }


    /* Large devices (laptops/desktops, 992px and up) */
    @media only screen and (min-width: 992px) {

    }


    /* Extra large devices (large laptops and desktops, 1200px and up) */
    @media only screen and (min-width: 1200px) {

    }

</style>
