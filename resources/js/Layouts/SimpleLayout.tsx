import {PropsWithChildren} from "react";
import SimpleNavLink from "@/Components/SimpleNavLink";

export default function SimpleLayout({ children }: PropsWithChildren) {
    return (
        <>
            <nav className="bg-gray-800 p-4 text-white">
                <SimpleNavLink href="/home">Home</SimpleNavLink>
                <SimpleNavLink href="/about">About</SimpleNavLink>
                <SimpleNavLink href="/contact">Contact</SimpleNavLink>
            </nav>

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                        {children}
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
