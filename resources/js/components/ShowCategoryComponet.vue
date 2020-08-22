<template>
    <div>
        <h2>Hello from Vue.js</h2>
        <div v-for="category in this.categories">
            <h4>{{ category.categoryname }}</h4>
            <ul>
                <li v-for="subcat in category.subcategories">
                    {{ subcat.subcategoryname }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: ["categories"],
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
