import { useState } from 'react';
import axios from 'axios';
import { Head } from '@inertiajs/react';

export default function Register() {
    const [data, setData] = useState({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });
    const [errors, setErrors] = useState({});
    const [processing, setProcessing] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setProcessing(true);
        try {
            await axios.post('/register', data);
            window.location.href = '/Tickets';
        } catch (error) {
            if (error.response && error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        } finally {
            setProcessing(false);
        }
    };

    return (
        <div className="flex flex-col items-center justify-center min-h-screen bg-gray-100 px-4">
            <Head title="Register" />
            <h1 className="text-2xl font-bold text-center text-gray-800">Register</h1>
            <div className="w-full max-w-md p-8 space-y-8 bg-white rounded-lg shadow-md">
                <form onSubmit={handleSubmit} className="space-y-6">
                    <div className="space-y-2">
                        <label htmlFor="name" className="block text-sm font-medium text-gray-700">Name</label>
                        <input
                            id="name"
                            type="text"
                            value={data.name}
                            onChange={e => setData({ ...data, name: e.target.value })}
                            required
                            autoFocus
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        />
                        {errors.name && <div className="text-red-500 text-sm">{errors.name}</div>}
                    </div>
                    <div className="space-y-2">
                        <label htmlFor="email" className="block text-sm font-medium text-gray-700">Email</label>
                        <input
                            id="email"
                            type="email"
                            value={data.email}
                            onChange={e => setData({ ...data, email: e.target.value })}
                            required
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        />
                        {errors.email && <div className="text-red-500 text-sm">{errors.email}</div>}
                    </div>
                    <div className="space-y-2">
                        <label htmlFor="password" className="block text-sm font-medium text-gray-700">Password</label>
                        <input
                            id="password"
                            type="password"
                            value={data.password}
                            onChange={e => setData({ ...data, password: e.target.value })}
                            required
                            autoComplete="new-password"
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        />
                        {errors.password && <div className="text-red-500 text-sm">{errors.password}</div>}
                    </div>
                    <div className="space-y-2">
                        <label htmlFor="password_confirmation" className="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            value={data.password_confirmation}
                            onChange={e => setData({ ...data, password_confirmation: e.target.value })}
                            required
                            autoComplete="new-password"
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>
                    <div>
                        <button
                            type="submit"
                            disabled={processing}
                            className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            {processing ? 'Registering...' : 'Register'}
                        </button>
                    </div>
                </form>
                <div className="mt-4 text-sm text-center">
                    <a href="/Login" className="font-medium text-indigo-600 hover:text-indigo-500">Login</a>
                </div>
            </div>
        </div>
    );
}
