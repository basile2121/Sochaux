import Vue from 'vue'
import DemoComponent from "./DemoComponent";

new Vue({
    components: { DemoComponent },
    template: "<DemoComponent />"
}).$mount("#demoComponent ");