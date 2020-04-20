@props([ 'title', 'href'])

<b-card
    :title="title"
    style="max-width: 20rem;"
    class="mb-2"
    >

    <b-card-text v-text="description"></b-card-text>

    <b-button :href="href" variant="primary" target="_blank" class="btn-sm">View on Github</b-button>
</b-card>