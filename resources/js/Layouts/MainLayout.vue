<template>
    <q-layout view="hHr lpR fFr">
        <q-header class="bg-white text-black q-py-sm" reveal>
            <q-toolbar class="q-gutter-sm">
                <q-btn
                    outline
                    :label="user.name"
                />

                <q-btn
                    no-caps
                    outline
                    :label="`Total Soal : ${exam.number_of_question}`"
                    v-if="this.$q.screen.gt.xs"
                />

                <q-btn
                    no-caps
                    outline
                    :label="`Soal dijawab : ${answeredQuestion}`"
                    v-if="this.$q.screen.gt.xs"
                />

                <q-btn
                    no-caps
                    outline
                    :label="`Belum dijawab : ${unAnsweredQuestion}`"
                    v-if="this.$q.screen.gt.xs"
                />

                <q-btn
                    no-caps
                    outline
                    color="primary"
                >
                    <countdown :time="timeRemaining">
                        <template slot-scope="props">
                            {{ props.hours }} : {{ props.minutes }} : {{ props.seconds }}
                        </template>
                    </countdown>
                </q-btn>
                <q-space/>
                <q-btn
                    label="Akhiri Ujian"
                    class="q-mr-sm"
                    color="primary"
                    v-if="$route.name === 'exam-question'"
                    @click="endExam"
                    :loading="loadingEnd"
                />
                <q-btn dense flat round icon="menu" @click="right = !right" />
            </q-toolbar>
        </q-header>

        <q-drawer show-if-above v-model="right" side="right" bordered>
            <q-scroll-area
                style="height: calc(100% - 60px); margin-top: 60px;"
                v-if="$route.name === 'exam-question'"
            >
                <div class="q-pa-sm">
                    <q-list>
                        <q-item
                            clickable
                            v-ripple
                            v-for="(question, index) in questions"
                            :key="`question-${index}`"
                            :active="idQuestion == index || question.hasOwnProperty('answer')"
                            :to="`/participant/app/exam/${codeExam}/${index}`"
                            :class="`${question.hasOwnProperty('answer') ? 'text-primary' : ''}`"
                        >
                            <q-item-section avatar>
                                <q-icon
                                    :name="`${question.hasOwnProperty('answer') ? 'check_circle' : 'remove_circle'}`"
                                />
                            </q-item-section>
                            <q-item-section>
                                Pertannyaan {{ index + 1 }}
                            </q-item-section>
                        </q-item>
                    </q-list>
                </div>
            </q-scroll-area>
            <div class="text-subtitle1 q-pa-md absolute-top">
                <div class="text-weight-bold">Navigasi Pertanyaan</div>
            </div>
        </q-drawer>

        <q-page-container>
            <router-view />
        </q-page-container>

        <q-footer :class="`bg-white text-black q-py-sm ${this.$q.screen.gt.xs ? 'shadow-5' : ''}`">
            <q-toolbar>
                <q-btn
                    v-if="$route.name === 'exam-question'"
                    @click="$router.push(`/participant/app/exam/${codeExam}/${getPrevious}`)"
                    label="Sebelumnya"
                    :disabled="!isPrevious"
                />
                <q-btn
                    v-if="$route.name === 'exam-question'"
                    class="q-ml-md"
                    @click="$router.push(`/participant/app/exam/${codeExam}/${getNext}`)"
                    label="Selanjutnya"
                    :disabled="!isNext"
                />
            </q-toolbar>
        </q-footer>

        <q-page-sticky expand position="top">
            <q-toolbar class="bg-white text-black shadow-up-3 text-h6">
                {{ exam.test_group }}
            </q-toolbar>
        </q-page-sticky>

        <q-page-sticky expand position="bottom" v-if="!$q.screen.gt.xs">
            <q-toolbar class="bg-white text-black shadow-3">
                <div>
                    Soal Terjawab: {{ answeredQuestion }}, Belum Terjawab: {{ unAnsweredQuestion }}
                </div>
            </q-toolbar>
        </q-page-sticky>
        <q-inner-loading :showing="loading">
            <q-circular-progress
                indeterminate
                size="50px"
                :thickness="0.22"
                color="primary"
                track-color="grey-3"
                class="q-ma-md"
            />
        </q-inner-loading>
    </q-layout>
</template>

<script>
    import { mapState } from 'vuex'
    import moment from 'moment'

    export default {
        name: 'App.vue',

        data () {
            return {
                leftDrawerOpen: false,
                tab: 'images',
                right: false,
                loading: false,
                loadingEnd: false
            }
        },

        mounted() {
            console.log(this.startDate)
            this.getExams()

            if (!this.$q.localStorage.has('exam_cpns_answers_' + this.codeExam)) {
                this.$q.localStorage.set('exam_cpns_answers_' + this.codeExam, [])
            }
        },

        computed: {
            ...mapState({
                exams: state => state.exam.exams,
                user: state => state.exam.exams.data.user,
                questions: state => state.exam.exams.data.exam.question,
                exam: state => state.exam.exams.data.exam
            }),

            answers () {
                return this.$q.localStorage.getItem('exam_cpns_answers_' + this.codeExam)
            },

            codeExam () {
                return this.$route.params.codeExam
            },

            idQuestion () {
                return this.$route.params.hasOwnProperty('id') ? this.$route.params.id : 0
            },

            getPrevious () {
                let previous = 0
                previous = parseInt(this.idQuestion) - 1

                return previous
            },

            getNext () {
                let previous = 0
                previous = parseInt(this.idQuestion) + 1

                return previous
            },

            isPrevious () {
                return this.getPrevious !== -1
            },

            isNext () {
                return this.getNext < this.questions.length
            },

            answeredQuestion () {
                return this.questions.reduce((counter, obj) => {
                    if (obj.hasOwnProperty('answer')) counter += 1
                    return counter;
                }, 0)
            },

            unAnsweredQuestion () {
                return this.questions.reduce((counter, obj) => {
                    if (!obj.hasOwnProperty('answer')) counter += 1
                    return counter;
                }, 0)
            },

            startDate () {
                return this.$q.localStorage.getItem('exam_cpns_start_date_' +  this.codeExam)
            },

            timeRemaining () {
                if (this.$q.localStorage.has('exam_cpns_start_date_' +  this.codeExam)) {
                    var now = moment()
                    var startDate = moment(this.startDate).add(90, 'minutes')

                    return startDate.diff(now, 'seconds') * 1000
                }

                return 0
            }
        },

        methods: {
            getExams() {
                this.loading = true
                this.$store.dispatch('exam/exams', {
                    codeExam: this.$route.params.codeExam,
                    form: {
                    }
                }).then((response) => {
                    this.loading = false
                }).catch(() => {
                    this.loading = false
                })
            },

            setAnswers () {
                let answers = this.answers

                this.questions.forEach((item, index) => {
                    const findAnswer = answers.find((answer, indexAnswer) => {
                        return answer.id_question == item.id_question
                    })

                    if (typeof findAnswer !== 'undefined') {
                        item.answer = findAnswer.answer
                    }
                })
            },

            endExam () {
                this.$q.dialog({
                    title: 'Konfirmasi',
                    message: 'Apakah anda yakin ingin mengakhiri ujian ini?',
                    cancel: true,
                    persistent: true
                }).onOk(() => {
                    let form = {
                        code_exam: this.codeExam,
                        user_answer: []
                    }
                    let answers = []
                    this.answers.forEach((answer, index) => {
                        const answerArr = answer.answer.split('-a-')

                        answers.push({
                            id_question: answer.id_question,
                            answer: answerArr[1],
                            id_answer: answerArr[0]
                        })
                    })

                    form.user_answer = answers

                    this.loadingEnd = true
                    this.loading = true
                    this.$store.dispatch('exam/examPost', {
                        form: {
                            ...form
                        }
                    }).then((response) => {
                        this.loadingEnd = false
                        this.loading = false
                        this.$q.notify({
                            type: 'positive',
                            message: `Terimakasih telah menyelesaikan ujian`
                        })

                        setTimeout(() => {
                            if (response.status === 'success') {
                                window.location.href = '/participant/home'
                            }
                        }, 1000);
                    }).catch(() => {
                        this.loading = false
                        this.loadingEnd = false
                    })
                })
            }
        },
    }
</script>

<style scoped>
</style>
