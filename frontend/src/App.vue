<template>
    <div>
        <header-bar></header-bar>
        <b-container>
            <b-row class="mt-5">
                <router-view></router-view>
            </b-row>
        </b-container>
    </div>
</template>

<script>
import HeaderBar from "@/components/HeaderBar.vue";
import RouterView from "@vue/cli-plugin-router";

export default {
    components: {
        HeaderBar,
        RouterView,
    },
    computed: {
        username() {
            // We will see what `params` is shortly
            return this.$route.params.username;
        },
    },
    methods: {
        goBack() {
            window.history.length > 1
                ? this.$router.go(-1)
                : this.$router.push("/");
        },
    },
};
</script>
