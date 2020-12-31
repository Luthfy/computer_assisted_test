<template>
    <q-page padding>
        <q-splitter
            v-if="$q.screen.gt.xs"
            v-model="splitterModel"
            style="height: 88vh"
        >

            <template v-slot:before>
                <div class="q-pa-md">
                    <displays></displays>
                </div>
            </template>

            <template v-slot:after>
                <div class="q-pa-md">
                    <preview></preview>
                </div>
            </template>

        </q-splitter>
        <div v-else class="q-pa-md">
            <displays></displays>
        </div>
    </q-page>
</template>

<script>
    import Displays from './../Components/Display'
    import Preview from './../Components/Preview'

    export default {
        name: 'Display.vue',

        components: { Preview, Displays },

        data() {
            return {
                splitterModel: 50
            }
        },

        mounted () {
        },

        methods: {
            logout() {
                window.axios.post('/auth/logout')
            }
        },
    }
</script>

<style scoped>

</style>
