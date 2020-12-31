<template>
    <q-page padding style="padding-top: 66px" class="flex flex-center">
        <q-card>
            <q-card-section>
                <div>
                    Jumlah Soal
                    <p class="text-weight-bold">{{ exam.number_of_question }}</p>
                </div>
                <div>
                    Durasi
                    <p class="text-weight-bold">{{ exam.duration }} Menit</p>
                </div>
            </q-card-section>
            <q-card-section>
                <q-btn
                    label="Mulai Ujian"
                    @click="startExam"
                    icon-right="chevron_right"
                />
            </q-card-section>
        </q-card>
    </q-page>
</template>

<script>
    import { mapState } from 'vuex'
    import moment from 'moment'

    export default {
        name: 'Exam.vue',

        data() {
            return {
            }
        },

        mounted () {
        },

        computed: {
            ...mapState({
                exam: state => state.exam.exams.data.exam
            }),

            codeExam () {
                return this.$route.params.codeExam
            },

            getFirstId () {
                return 0
            }
        },

        methods: {
            startExam () {
                if (!this.$q.localStorage.has('exam_cpns_start_date_' + this.codeExam)) {
                    this.$q.localStorage.set('exam_cpns_start_date_' + this.codeExam, moment())
                }
                this.$router.push(`/participant/app/exam/${this.codeExam}/${this.getFirstId}`)
            }
        },
    }
</script>

<style scoped>

</style>
