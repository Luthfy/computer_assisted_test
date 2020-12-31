import { LocalStorage } from 'quasar/dist/quasar.umd.min'

export function exams (state, data) {
    return window.axios.get('/api/user_question/' + data.codeExam, {
        params: {
            ...data.form
        },
        headers: {
            ...data.headers
        }
    }).then((response) => {
        if (LocalStorage.has('exam_cpns_answers_' + data.codeExam)) {
            let answers = LocalStorage.getItem('exam_cpns_answers_' + data.codeExam)

            response.data.data.exam.question.forEach((item, index) => {
                const findAnswer = answers.find((answer, indexAnswer) => {
                    return answer.id_question == item.id_question
                })

                if (typeof findAnswer !== 'undefined') {
                    item.answer = findAnswer.answer
                }
            })
        }

        state.commit('setExams', response.data)

        return response.data
    }).catch(function (error) {
        return error.data
    })
}

export function examPost (state, data) {
    return window.axios.post('/api/user_answer',
        {
            ...data.form
        },
        {
            headers: {
                ...data.headers
            }
        }).then((response) => {

        return response.data
    }).catch(function (error) {
        return error.data
    })
}
