<template>
    <q-page padding>
        <q-splitter
            v-if="$q.screen.gt.xs"
            v-model="splitterModel"
            style="height: 88vh"
        >
            <template v-slot:before>
                <div class="q-px-md">
                    <links></links>
                </div>
            </template>

            <template v-slot:after>
                <div class="q-pa-md">
                    <preview></preview>
                </div>
            </template>

            <q-inner-loading :showing="loading">
                <q-spinner-gears size="50px" color="primary" />
            </q-inner-loading>
        </q-splitter>
        <div v-else class="q-pa-md">
            <links></links>
        </div>
        <q-page-sticky position="bottom" :offset="[100, 18]" style="z-index: 2">
            <q-fab
                v-model="fabAction"
                vertical-actions-align="left"
                icon="fas fa-plus"
                direction="up"
                class="my-bg text-white"
                label="Tambah Link"
            >
                <q-fab-action class="my-bg text-white" padding="10px" external-label @click="store('IMAGE')" icon="fas fa-image" label="Gambar" v-close-popup />
                <q-fab-action class="my-bg text-white" padding="10px" external-label @click="store('BUTTON')" icon="fas fa-link" label="Tombol" v-close-popup />
            </q-fab>
        </q-page-sticky>
    </q-page>
</template>

<script>
    import Links from './../Components/Link'
    import Preview from './../Components/Preview'
    export default {
        name: 'Link.vue',

        components: { Links, Preview },

        data() {
            return {
                splitterModel: 50,
                loading: false,
                fabAction: false
            }
        },

        mounted () {
        },

        methods: {
            getLinks() {
                this.loading = true
                this.$store.dispatch('link/list', {
                    form: {
                        type: 'BUTTON'
                    }
                }).then((response) => {
                    this.loading = false
                }).catch(() => {
                    this.loading = false
                })
            },

            getLinkImages () {
                this.loading = true
                this.$store.dispatch('link/list', {
                    form: {
                        type: 'IMAGE'
                    }
                }).then((response) => {
                    this.loading = false
                }).catch(() => {
                    this.loading = false
                })
            },

            refreshLink (type) {
                if (type === 'BUTTON') {
                    this.getLinks()
                } else if (type === 'IMAGE') {
                    this.getLinkImages()
                } else {
                    this.getLinks()
                    this.getLinkImages()
                }
            },

            store(type) {
                this.$store.dispatch('link/store', {
                    form: {
                        type: type,
                        name: 'Judul Link',
                        url: null,
                    }
                }).then((response) => {
                    this.linkType = false
                    this.refreshLink(type)
                    this.$q.notify({
                        icon: 'thumb_up',
                        timeout: 750,
                        color: 'positive',
                        textColor: 'white',
                        message: 'Berhasil menambah link'
                    })
                })
            },
        },
    }
</script>

<style scoped>

</style>
