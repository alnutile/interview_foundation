@props([ 'name', 'url'])

<b-card
    title="name"
    style="max-width: 20rem;"
    class="mb-2"
    >
    <b-card-text >@{{name}}</b-card-text>

    <b-button href="url" variant="primary" target="_blank" class="btn-sm">View on Github</b-button>
</b-card>