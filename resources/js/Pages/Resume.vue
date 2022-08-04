<template>
    <div class="container flex flex-col justify-center mx-auto">
        <div class="flex flex-col justify-center items-center mt-5 mb-12 mx-5">
            <div class="max-w-4xl w-full text-center">
                <h1 class="font-sans font-normal text-[38px] mb-[10px]">{{ resume.name }}</h1>
                <h2 class="mb-[6px]">{{ resume.position }}</h2>
                <ul class="flex justify-center content-center">
                    <li v-for="(info, index) in resume.contact_info" class="mx-4">
                        <i class="mx-1 fa" :class="index === 'phone' ? 'fa-phone' : 'fa-envelope'"></i>
                        <span>{{ info }}</span>
                    </li>
                </ul>
                <hr class="mt-16">
            </div>
        </div>

        <div class="flex flex-col justify-center items-center mx-5">
            <div class="max-w-4xl w-full text-justify">
                <div class="mb-16">
                    <h2 class="text-2xl mb-3">Summary</h2>
                    <p>{{ resume.summary }}</p>
                </div>

                <hr>

                <div class="my-12">
                    <h2 class="text-2xl mb-3">Work History</h2>
                    <div v-for="(work, index) in work_histories">
                        <div class="experience-item position mb-3 mt-5" :class="index !== 0 ? 'mt-10' : ''">
                            <h3 class="font-semibold text-lg my-2">{{ work.title }}</h3>
                            <h3 class="font-normal my-2">{{ work.company }}</h3>
                            <p class="font-normal my-2 mb-3">{{ work.start }} - {{ work.end }}</p>

                            <div class="summary-container">
                                <div class="summary" v-html="work.detail"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="my-12">
                    <h2 class="text-2xl mb-3">Education</h2>
                    <div v-for="(education, index) in educations">
                        <div class="experience-item position mb-3 mt-5" :class="index !== 0 ? 'mt-10' : ''">
                            <h3 class="font-semibold my-2 text-lg">{{ education.institute }}</h3>
                            <h3 class="font-normal my-2">{{ education.major }}</h3>
                            <p class="font-normal my-2 mb-3">{{ education.start }} - {{ education.end }}</p>
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
