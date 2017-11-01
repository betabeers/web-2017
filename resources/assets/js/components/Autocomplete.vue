<template>
    <form id="panel-user-search" class="form-horizontal" method="get" autocomplete="off"
          v-on:submit.prevent
          v-click-outside="empty">
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="keyword" placeholder="Buscar Usuario" id="panel-user-search_input" class="form-control"
                       v-model="query"
                       v-on:input="autocomplete"
                       @keydown.down="moveDown"
                       @keydown.up="moveUp"
                >
                <div id="panel-user-search_addon" class="input-group-addon">
                    <i class="fa fa-spin fa-circle-o-notch" v-if="searching"></i>
                    <i class="fa fa-search" v-else></i>
                </div>
            </div>
        </div>
        <div id="panel-user-search_results" class="search-results" v-if="results.length">
                <a v-for="(result, index) in results"
                   :href="result.url"
                   :class="{
                       'selected' : index == selected
                   }"
                   v-on:mouseover="selectOnHover(index)">
                    {{result.name}} <small>({{result.email}})</small>
                </a>
        </div>
    </form>
</template>


<script>
    export default {
        data() {
            return {
                query: '',
                results: [],
                selected: 0,
                searching: false,
            }
        },
        methods: {
            empty() {
                this.results = [];
                this.selected = 0;
            },
            autocomplete() {
                this.empty();
                this.searching = true;
                if(this.query.length > 2){
                    axios.get('/admin/users/search', {
                        params:{
                            keyword: this.query
                        }
                    }).then(response => {
                        this.results = response.data;
                        this.searching = false;
                    })
                }else{
                    this.searching = false
                }
            },
            moveUp() {
                if(this.selected === 0) return;
                this.selected--;
                if(this.selected > 8){
                    console.log(this.selected * 34);
                    document.getElementById('panel-user-search_results').scrollTop = 34 + ((this.selected - 8) * 34);
                }
            },
            moveDown() {
                if(this.selected === (this.results.length -1)) return;
                this.selected++;
                if(this.selected > 8){
                    console.log(this.selected * 34);
                    document.getElementById('panel-user-search_results').scrollTop = 34 + ((this.selected - 8) * 34);
                }
            },
            selectOnHover(index) {
                this.selected = index;
            },
        }
    }
</script>