<template>
    <div class="w-100 mt-5">
        <div class="row">
            <div class="col-12 p-2">
                <div
                    class="categorybox w-100 align-items-center py-1"
                    @click="selectedAll()"
                >
                    <div class="text-center">Show all links</div>
                </div>
            </div>
            <div
                class="p-2 col-4"
                v-for="(category, key) in categories"
                :key="key"
            >
                <div
                    class="categorybox w-100 align-items-center py-1"
                    @click="selectedCat(category.id)"
                >
                    <div class="text-center">{{ category.categoryname }}</div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div
                class="p-2 col-4"
                v-for="(subcategory, key) in filteredSubCategories"
                :key="key"
            >
                <div
                    class="categorybox w-100 align-items-center py-1"
                    @click="selectedsubCat(subcategory.id)"
                >
                    <div class="text-center">
                        {{ subcategory.subcategoryname }}
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div
                    class="col-6 p-2"
                    v-for="(domain, key) in filteredDomains"
                    :key="key"
                >
                    <div class="card">
                        <div class="card-body">
                            <p>
                                <strong>Website name:</strong>
                                {{ domain.title }}
                            </p>
                            <p>
                                <strong>Website URL:</strong>
                                <a :href="domain.url">{{ domain.url }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    // props: ["domains", "categories", "subcategories"],
    data() {
        return {
            selectedcategory: "",
            selectedsubcategory: ""
        };
    },
    methods: {
        selectedAll: function() {
            this.selectedcategory = "";
            this.selectedsubcategory = "";
        },
        selectedCat: function(id) {
            this.selectedcategory = id;
            this.selectedsubcategory = "";
        },
        selectedsubCat: function(id) {
            this.selectedsubcategory = id;
        }
    },
    computed: {
        filteredSubCategories: function() {
            return this.subcategories.filter(
                item => item.category_id == this.selectedcategory
            );
        },
        filteredDomains: function() {
            if (
                this.selectedcategory === "" &&
                this.seletedsubcategory === ""
            ) {
                return this.domains;
            } else if (
                this.selectedcategory === "" &&
                this.seletedsubcategory != ""
            ) {
                return this.subcategories.filter(
                    item => item.subcategory_id == this.selectedcategory
                );
            } else if (
                this.selectedcategory != "" &&
                this.seletedsubcategory === ""
            ) {
                return this.subcategories.filter(
                    item => item.category_id == this.selectedcategory
                );
            }
        }
    }
};
</script>

<style></style>
