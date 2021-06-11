<template>
    <div class="container">
        <div class="row justify-content-center pt-3">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" v-model="term"
                           aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" @click="onSearch">Search</button>
                    </div>
                </div>

                <div class="card mb-2" v-for="post in posts">
                    <div class="card-header">{{ post.description }}</div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" v-for="comment in post.comments">{{ comment.comment }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            term: "",
            posts: []
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        getPosts() {
            fetch('http://localhost:8000/api/posts')
                .then(response => response.json())
                .then(data => this.posts = data.data);
        },
        onSearch() {
            fetch('http://localhost:8000/api/posts-search?' + new URLSearchParams({
                term: this.term
            }))
                .then(response => response.json())
                .then(data => this.posts = data.data);
        }
    }
}
</script>
