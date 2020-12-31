<template>
    <q-page padding style="padding-top: 66px">
        <q-card flat bordered>
            <q-card-section class="text-subtitle1">
                <q-icon
                    name="check_circle"
                    color="primary"
                    class="float-right"
                    v-if="question.hasOwnProperty('answer')"
                    size="24px"
                />
                <div
                    class="text-h6"
                >
                    Pertanyaan {{ parseInt(this.$route.params.id) + 1 }}
                </div>
                <div
                    v-if="question.hasOwnProperty('text_question')"
                    v-html="question.text_question"
                ></div>
            </q-card-section>
            <q-card-section
                class=""
                v-if="question.hasOwnProperty('opsion_answer')"
            >
                <div
                    v-for="(option, index) in question.opsion_answer"
                    :key="`option-${index}`"
                >
                    <q-item tag="label" v-ripple>
                        <q-item-section avatar>
                            <q-radio
                                dense
                                v-model="question.answer"
                                :val="`${option.id}-a-${option.text_answer}`"
                                @input="setAnswer(question)"
                            />
                        </q-item-section>
                        <q-item-section>
                            <q-item-label v-html="option.text_answer"></q-item-label>
                        </q-item-section>
                    </q-item>
                </div>
            </q-card-section>
        </q-card>
    </q-page>
</template>

<script>
    import { mapState } from 'vuex'

    export default {
        name: 'ExamQuestion.vue',

        data() {
            return {
                question: {
                    id_question: 0,
                    selection_group: null,
                    text_question: null,
                    sub_test: null,
                    opsion_answer: [],
                    answer: 0
                }
            }
        },

        mounted () {
            if (this.$route.params.id == 0) {
                this.getQuestion()
            }
        },

        computed: {
            ...mapState({
                exams: state => state.exam.exams,
                questions: state => state.exam.exams.data.exam.question,
                exam: state => state.exam.exams.data.exam
            }),

            codeExam () {
                return this.$route.params.codeExam
            },

            idQuestion () {
                return this.$route.params.id
            },

            answers () {
                return this.$q.localStorage.getItem('exam_cpns_answers_' +  this.codeExam)
            }
        },

        methods: {
            getQuestion () {
                const question = this.questions[this.idQuestion]

                this.question = question
            },

            setAnswer (question) {
                let answers = this.answers
                let isFind = false
                answers.forEach((item, index) => {
                    if (item.id_question == question.id_question) {
                        item.answer = question.answer
                        isFind = true
                    }
                })

                if (!isFind) {
                    answers.push({
                        id_question: question.id_question,
                        answer: question.answer
                    })
                }

                this.$q.localStorage.set('exam_cpns_answers_' +  this.codeExam, answers)
            }
        },

        watch: {
            questions(newValue, oldValue) {
                this.getQuestion()
            },

            idQuestion (newValue, oldValue) {
                this.getQuestion()
            }
        },
    }
</script>

<style scoped>

</style>
