const errorComponent = {
    props: ["error"],
    template: `
        <div class="alert alert-danger" role="alert" v-if="error">{{ error }}</div>
    `,
};
