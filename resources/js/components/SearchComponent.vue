<template>
    <div>

        <input class="form-control form-control-lg"autofocus v-model="keyword" type="search" placeholder="Tasks Search Here ..."
               aria-label="Search" v-on:keyup="SearchBlogs">
        <ul class="list-group">
            <li class="list-group-item" v-for="result in results">
                <a :href=" 'tasks'  + '/'+result.id +'/show' " style="color: black;">
                    {{ result.name }}
                </a>
            </li>
        </ul>
    </div>

</template>

<script>
export default {
name: "SearchComponent",

    data(){
        return {
            keyword:'',
            results:[],

        }
    },

    methods:{
        SearchBlogs(){
            this.results =[];
            if (this.keyword.length >= 1){
                axios.get('tasks/all/search',{params:{keyword:this.keyword}}).then(response=>{
                    console.log(this.results)
                    this.results = response.data;
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
