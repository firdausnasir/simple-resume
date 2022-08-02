<template>
    <div class="view-candidate-wrapper">
        <div class="printable wrapper">
            <div class="candidate print">
                <div class="candidate-main">
                    <div class="candidate-header">
                        <div class="candidate-info bump">
                            <h1 class="name">{{ resume.name }}</h1>
                            <h2 class="headline">{{ resume.position }}</h2>
                            <ul class="contact-points">
                                <li v-for="(info, index) in resume.contact_info" class="candidate-detail-item">
                                    <i class="fa" :class="index === 'phone' ? 'fa-phone' : 'fa-envelope'"></i> <span>{{ info }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="candidate-content">
                        <div class="candidate-experience">
                            <section class="section summary-container">
                                <h1 class="section-header">Summary</h1>
                                <div class="summary"><p>{{ resume.summary }}</p></div>
                            </section>
                        </div>
                        <div class="candidate-experience">
                            <section class="section work-history-container">
                                <h1 class="section-header">Work History</h1>
                                <div class="positions">
                                    <div v-for="work in work_histories">
                                        <div class="experience-item position mb-3">
                                            <div class="name"><h3>{{ work.title }}</h3></div>
                                            <div class="company"><h3>{{ work.company }}</h3></div>
                                            <div class="dates"><p class="dates">{{ work.start }} - {{ work.end }}</p></div>
                                            <div class="summary-container">
                                                <div class="summary" v-html="work.detail"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="candidate-experience">
                            <section class="section education-container">
                                <h1 class="section-header">Education</h1>
                                <div class="positions">
                                    <div class="experience-item position" v-for="education in educations">
                                        <div class="name"><h3>{{ education.institute }}</h3></div>
                                        <div class="company"><h3>{{ education.major }}</h3></div>
                                        <div class="dates"><p class="dates">{{ education.start }} - {{ education.end }}</p></div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Resume",
    props: {
        resume: Object,
        work_histories: Object,
        educations: Object
    }
}
</script>

<style scoped>

</style>
