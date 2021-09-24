<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <script>
        var parentCategories = JSON.parse('<?= json_encode($parentCategories); ?>');
    </script>
    <div id='app'>
        <category-select 
            label="Parent Categories"
            :categories="parentCategories" 
            ></category-select>
        
        
    </div>
    <script>
        Vue.component('category-select', {
            props: ['categories', 'categoryName', 'label'],
            data: function () {
                return {
                    selectedCategory: "",
                    subCategories: [],
                    
                }
            },
            methods: {
                getSubCategories(event) {
                    axios.get('/category/get/' + this.selectedCategory)
                    .then(response => {
                        this.subCategories = response.data
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                },
                getSelectedCategoryName() {
                    let selectedCategory = this.categories.filter(item => {
                        return item.id === this.selectedCategory
                    })
                    return selectedCategory[0].name
                }
            },
            template: `
                <div>
                    <label v-if="label">{{label}}</label>
                    <label v-else>Sub Categories of Category <strong class="text-danger">{{ categoryName }}</strong></label>
                    <select name="categories" class="form-select" v-model="selectedCategory" @change="getSubCategories">
                        <option value="">select one</option>
                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                    </select>
                    <category-select v-if="subCategories.length > 0" :categories="subCategories" :category-name="getSelectedCategoryName()"></category-select>
                </div>

            `
        })
        
        var app = new Vue({
            el: '#app',
            data: {
                parentCategories: parentCategories
            },
            methods: {
            }
        })
        

        
    </script>
<?= $this->endSection() ?>