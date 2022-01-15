<template>
    <div>Hello, Example Component!</div>
</template>

<script>
export default {
    mounted() {
        console.log('Example component mounted.')
    },
    login() {
        this.axios
            .get(`http://localhost:8000/api/login`)
            .then((response) => {
                this.post = response.data;
                // console.log(response.data);
            });
    },
}
</script>
