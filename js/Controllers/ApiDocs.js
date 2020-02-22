import SwaggerUI from 'swagger-ui'

export default class {
    constructor(page, data) {
        SwaggerUI({
            domNode: page.addChild('.swaggerContainer'),
            url:'/ApiDocs/definition'
        })
    }
}