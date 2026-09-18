import SwaggerUI from 'swagger-ui'
import 'swagger-ui/dist/swagger-ui.css'
export default class {
    constructor(page, data) {
        const swagger=SwaggerUI({
            domNode: page.addChild('.swaggerContainer'),
            url:'/ApiDocs/definition',
            deepLinking: true,
            onComplete: () => {
                const key=/key=([^&]+)/.exec(location.search)[1];
                swagger.preauthorizeApiKey('apiKey', key)

            }
        })
    }
}
