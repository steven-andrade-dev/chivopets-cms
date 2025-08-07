// src/utils/httpClient.js
import axios from 'axios'
import Swal from 'sweetalert2'


const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
})

api.interceptors.request.use((config) => {
  const token = localStorage.getItem("auth_token")
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

export async function httpRequest({
  method = 'get',
  url = '',
  data = null,
  params = {},
  token = null,
  headers = {}
}) {
  try {
    const response = await api.request({
      method,
      url,
      data,
      params,
      headers: {
        'Content-Type': 'application/json',
        ...headers,
      }
    })
    return response.data
  } catch (error) {
    if (error.response.status == 401) {
        localStorage.removeItem("auth_token")
        location.href = '/login'
  } else {
     Swal.fire({
          title: 'Error',
          text: 'Error al procesar la solicitud, Intenta nuevamente',
          icon: 'error',
      })
  }
    throw error
  }
}
