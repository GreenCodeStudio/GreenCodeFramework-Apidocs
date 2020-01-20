import SwaggerUI from 'swagger-ui'

export default class {
    constructor(page, data) {
        this.page = page;
        this.data = data;
        console.log('dd')
        SwaggerUI({
            domNode: page.addChild('.swaggerContainer'),
            url:'/ApiDocs/definition'
        })
    }
}