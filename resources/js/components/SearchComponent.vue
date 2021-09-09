<template>
    <div>

        <input class="form-control form-control-lg"autofocus v-model="keyword" type="search" placeholder="Tasks Search Here ..."
               aria-label="Search" v-on:keyup="SearchBlogs">
        <ul class="list-group">
            <li class="list-group-item" v-for="result in results" :key="result.id">
                <a @click="ShowModal(result)" style="color: black;">
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
            tasks:[]

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
        },
        ShowModal(result){
            // console.log(result.id)
            axios.get('tasks/'+result.id+'/show',{params:{data:this.tasks}}).then(response=>{
                console.log(response.data['name'])
                $('#show-Modal').modal('show');
                $("#show-Modal .modal-body").append('<h4>'+response.data['name']+'</h4>');
                $("#show-Modal .modal-body").empty().append('<h4>'+'Task Name : '+response.data['name']+'</h4>'+'<br>'+'<h4>'+'Description : '+response.data['description']+'</h4>');
                // this.results =task
            })
        }
    }
}
</script>

<style scoped>

</style>
