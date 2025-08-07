import axios from 'axios'

const API_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api'

export interface RegisterData {
  studentId: string
  name: string
  email: string
  password: string
  password_confirmation: string
}

export const authService = {
  async register(data: RegisterData) {
    try {
      const response = await axios.post(`${API_URL}/register`, data)
      if (response.data.token) {
        localStorage.setItem('token', response.data.token)
      }
      return response.data
    } catch (error: any) {
      throw error.response?.data?.message || 'Registration failed'
    }
  }
}
