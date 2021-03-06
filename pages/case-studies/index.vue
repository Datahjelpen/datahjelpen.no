<style lang="scss" module>
.root {
  margin: $space-large auto;
}

.root > h1 {
  text-align: center;
  margin-bottom: $space-medium;

  @media ($media-min-medium) {
    margin-bottom: $space-xxlarge;
  }
}
</style>
<template>
  <Layout :class="$style.root" v-if="cases">
    <h1 v-if="page.heading">{{ page.heading }}</h1>
    <p v-if="page.intro">{{ page.intro }}</p>
    <InfoSection2 :id="cases.sectionNameSlug">
      <MasonryGrid slot="items">
        <ProjectCard
          v-for="(customerCase, slug, i) in cases.items"
          :slot="'item-' + (i + 1)"
          :key="'customerCase-card-' + i"
          :title="customerCase.title"
          :link="
            localePath({
              name: 'case-studies-slug',
              params: { slug: slug }
            })
          "
          :image="customerCase.poster"
          :overlay="customerCase.overlay"
          :overlayHover="customerCase.overlayHover"
        >
        </ProjectCard>
      </MasonryGrid>
    </InfoSection2>
  </Layout>
</template>
<script>
import Layout from '../../components/Layout'
import InfoSection2 from '../../components/InfoSection2'
import ProjectCard from '../../components/ProjectCard'
import MasonryGrid from '../../components/MasonryGrid'

export default {
  head: {
    title: 'Kundecaser - Datahjelpen AS'
  },
  nuxtI18n: {
    paths: {
      en: '/case-studies',
      nb: '/kundecaser'
    }
  },
  components: {
    InfoSection2,
    ProjectCard,
    Layout,
    MasonryGrid
  },
  async asyncData({ app: { $axios, i18n } }) {
    // Get index page data
    const url = '/i18n/' + i18n.locale + '/index.json'
    const data = await $axios
      .get(url)
      .then(res => {
        res.data.page = {
          heading: i18n.t('Kundecaser')
        }
        return res.data
      })
      .catch(e => {
        return {
          page: {
            heading: i18n.t('Kundecaser'),
            intro: i18n.t('Noe gikk feil. Vi klarte ikke hente data ...')
          },
          cases: {}
        }
      })

    // Get case studies data
    const casesUrl = '/i18n/' + i18n.locale + '/case-studies.json'
    const casesData = await $axios
      .get(casesUrl)
      .then(res => {
        return res.data
      })
      .catch(e => {
        return {
          items: []
        }
      })

    if (data && typeof data === 'object') {
      data.cases.items = casesData.items
      return { ...data }
    }
  }
}
</script>
