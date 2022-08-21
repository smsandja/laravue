<template>
    <div class="container">
            <ul class="list-group">
              <li class="list-group-item"><a href="#">Tache 1</a></li>
               <li class="list-group-item"><a href="#">Tache 2</a></li>
               <li class="list-group-item"><a href="#">Tache 3</a></li>
               <li class="list-group-item"><a href="#">Tache 4</a></li>
           </ul>
    </div>
</template>

<script>

    export default {
    data () {
        return {
            tasks: {}
         }
     },
    created() {
        axios.get('http://127.0.0.1/tasksList')
            .then(response => this.tasks = response.data)
            .catch(error => console.log(error));
     },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
