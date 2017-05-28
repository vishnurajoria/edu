Vue.component('course-list', {
    template: '<div class="panel panel-default">' +
                '<div class="panel-heading"><h1>All Courses</h1></div>' +
                    '<div class="panel-body">' +

                        '<course v-for="course in courses" :title="course.title" :href="courseUrl(course.id)" :description="courseExcerpt(course.description, 75)"></course>'+

                        '<div class="col-md-12"><button @click="loadMoreCourses()" class="btn btn-primary">Load more</button></div>'+
                    '</div>'+
                '</div>'+
            '</div>',

    data: function () {
        return {
            courses: [],
            current_page : 0
        }
    },
    mounted: function(){
        axios.get('/api/courses')
            .then(function (response) {
                this.courses = response.data.courses.data;
                this.current_page = response.data.courses.current_page;
                // console.log(response.data);
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            })
    },
    methods: {
        courseUrl: function (course_id) {
            return '/courses/'+course_id;
        },
        courseExcerpt: function (description, length) {
            return description.substr(0, length)+'...';
        },
        loadMoreCourses: function () {
            axios.get('/api/courses', {
                    params: {
                        page: this.current_page + 1
                    }
                })
                .then(function (response) {
                    this.courses = this.courses.concat(response.data.courses.data);
                    this.current_page = response.data.courses.current_page;
                    // console.log(response.data);
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                })
        }
    }
});

Vue.component('course', {
    props: ['title', 'href', 'description'],
    template: '<div class="col-sm-6">'+
                '<div class="panel panel-info">'+
                    '<div class="panel-heading"><a :href="href">{{ title }}</a></div>'+
                    '<div class="panel-body">'+
                        // '<p>Date: {{ course.created_at }}</p>'+
                        // '<p>Author: {{ course.author_id }}</p>'+
                        '<p>Description: {{ description }}</p>'+
                    '</div>'+
                '</div>'+
            '</div>'
});

const app = new Vue({
    el: '#app-container',
    data: {
        courses: []
    },
    mounted: function(){
        axios.get('/api/courses')
            .then(function (response) {
                this.courses = response.data.courses;
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            })
    }
});

// jQuery(document).ready(function() {
//     jQuery('#flash-message').delay(500).fadeIn(250).delay(3000).fadeOut(500);
// });

function toggleClass(element_id, toggle_class) {
    var myButtonClasses = document.getElementById(element_id).classList;

    if (myButtonClasses.contains(toggle_class)) {

        myButtonClasses.remove(toggle_class);

    } else {

        myButtonClasses.add(toggle_class);

    }
}