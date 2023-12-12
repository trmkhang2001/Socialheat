const HttpMethod = {
    GET: 'GET', POST: 'POST',
};

class ResponseError extends Error {
    static showError(error) {
        toastr['error'](error);
    }
}

class ConnectionError extends Error {
    constructor(response) {
        super(response.message);
    }
}

const handleError = async (response) => {
    const responseInternal = response.clone();
    const text = await responseInternal.text();
    const result = JSON.parse(text);
    if (result.hasOwnProperty('status') && !result.status) {
        ResponseError.showError(result.msg);
    }

    if (!response.ok) {
        ResponseError.showError(text);
    }
};

const getResponseJson = async (response) => {
    const text = await response.text();

    if (text === '') return '';

    try {
        return JSON.parse(text);
    } catch (error) {
        throw new Error(error.message);
    }
};

const request = async (url, options = {}) => {
    const {method, headers, body, abortSignal} = options;

    const response = await fetch(url, {
        method, headers, body, signal: abortSignal,
    }).catch((error) => {
        throw new ConnectionError(error);
    });

    await handleError(response);

    return response;
};

const getRequest = async (url, params = {}, options = {}) => {
    let endpoint = url;
    if (params) {
        const searchParams = new URLSearchParams();
        Object.entries(params).forEach(([key, value]) => searchParams.set(key, value));

        endpoint += `?${searchParams.toString()}`;
    }

    return await request(endpoint, {
        ...options, method: HttpMethod.GET,
    });
};

const postRequest = async (url, body = {}, options = {}) => {
    return await request(url, {
        ...options, body, method: HttpMethod.POST,
    });
};

const getUrl = (uri) => {
    return site_url + uri;
}
