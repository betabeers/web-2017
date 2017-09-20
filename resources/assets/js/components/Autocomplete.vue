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
                <div id="panel-user-search_spinner" class="input-group-addon d-none">
                    <i class="fa fa-spin fa-circle-o-notch"></i>
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
            }
        },
        methods: {
            empty() {
                this.results = [];
                this.selected = 0;
            },
            autocomplete() {
                this.empty();
                document.getElementById('panel-user-search_spinner').classList.remove('d-none');
                if(this.query.length > 2){
                    axios.get('/admin/users/search', {
                        params:{
                            keyword: this.query
                        }
                    }).then(response => {
                        this.results = response.data;
                        document.getElementById('panel-user-search_spinner').classList.add('d-none');
                    })
                }else{
                    document.getElementById('panel-user-search_spinner').classList.add('d-none');
                }
            },
            moveUp() {
                if(this.selected === 0) return;
                this.selected--;
            },
            moveDown() {
                if(this.selected === (this.results.length -1)) return;
                this.selected++;
            },
            selectOnHover(index) {
                this.selected = index;
            },
        }
    }
</script>